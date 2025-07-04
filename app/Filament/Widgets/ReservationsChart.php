<?php

namespace App\Filament\Widgets;

use App\Models\Reservation;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;

class ReservationsChart extends ChartWidget
{
    protected static ?string $heading = 'Reservasi per Bulan';
    protected static ?int $sort = 1;
    protected static ?string $maxHeight = '300px';
    protected int | string | array $columnSpan = 'half';

    public ?string $from = null;
    public ?string $to = null;

    public function getFormSchema(): array
    {
        return [
            DatePicker::make('from')->label('Dari')->default(now()->startOfMonth()),
            DatePicker::make('to')->label('Sampai')->default(now()),
        ];
    }

    protected function getData(): array
    {
        $from = $this->from ?? now()->startOfMonth()->toDateString();
        $to = $this->to ?? now()->toDateString();
        $data = Reservation::whereBetween('tanggal_reservasi', [$from, $to])->get();

        $data = Trend::model(Reservation::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Reservasi',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                    'backgroundColor' => '#10B981',
                    'borderColor' => '#10B981',
                    'tension' => 0.3,
                    'fill' => true,
                    'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => Carbon::parse($value->date)->locale('id')->isoFormat('MMM')),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'stepSize' => 1,
                    ],
                ],
            ],
        ];
    }
}
