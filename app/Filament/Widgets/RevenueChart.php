<?php

namespace App\Filament\Widgets;

use App\Models\Reservation;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Filament\Support\RawJs;

class RevenueChart extends ChartWidget
{
    protected static ?string $heading = 'Pendapatan per Bulan';
    protected static ?int $sort = 1;
    protected static ?string $maxHeight = '300px';
    protected int | string | array $columnSpan = 'half';

    protected function getData(): array
    {
        // Generate array of all months in current year
        $months = collect(range(1, 12))->map(function ($month) {
            return [
                'month' => Carbon::create(null, $month, 1)->format('Y-m'),
                'total_revenue' => 0
            ];
        });

        // Get actual revenue data
        $revenueData = DB::table('reservasis')
            ->select(
                DB::raw('DATE_FORMAT(tanggal_reservasi, "%Y-%m") as month'),
                DB::raw('SUM(harga) as total_revenue')
            )
            ->whereYear('tanggal_reservasi', now()->year)
            ->where('status', '!=', 'cancelled')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month');

        // Merge actual data with all months
        $data = $months->map(function ($item) use ($revenueData) {
            if (isset($revenueData[$item['month']])) {
                return [
                    'month' => $item['month'],
                    'total_revenue' => $revenueData[$item['month']]->total_revenue
                ];
            }
            return $item;
        });

        return [
            'datasets' => [
                [
                    'label' => 'Pendapatan',
                    'data' => $data->map(fn ($item) => (float) $item['total_revenue']),
                    'backgroundColor' => '#10B981',
                    'borderColor' => '#10B981',
                    'tension' => 0.3,
                    'fill' => true,
                    'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                ],
            ],
            'labels' => $data->map(function ($item) {
                return Carbon::createFromFormat('Y-m', $item['month'])->locale('id')->isoFormat('MMM');
            }),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): RawJs
    {
        return RawJs::make(<<<JS
            {
                plugins: {
                    legend: {
                        display: false,
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            }
        JS);
    }
}
