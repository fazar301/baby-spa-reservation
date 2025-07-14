<?php

namespace App\Filament\Widgets;

use App\Models\Reservation;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class ReservationStats extends BaseWidget
{
    protected static ?int $sort = 1;
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        // Query for top layanan this month
        $topService = Reservation::select('layanan_id', DB::raw('count(*) as total'))
            ->whereMonth('tanggal_reservasi', now()->month)
            ->whereYear('tanggal_reservasi', now()->year)
            ->groupBy('layanan_id')
            ->orderByDesc('total')
            ->with('layanan')
            ->first();
        $topServiceName = $topService && $topService->layanan ? $topService->layanan->nama_layanan : '-';
        $topServiceCount = $topService ? $topService->total : 0;

        // Prepare date range for the last 8 days
        $dates = collect(range(7, 0))->map(function ($i) {
            return now()->subDays($i)->toDateString();
        });

        // Query for trends
        $totalTrend = Reservation::whereBetween('tanggal_reservasi', [$dates->first(), $dates->last()])
            ->selectRaw('DATE(tanggal_reservasi) as date, COUNT(*) as count')
            ->groupBy('date')
            ->pluck('count', 'date');
        $totalTrendArr = $dates->map(fn($date) => $totalTrend[$date] ?? 0)->toArray();

        $todayTrendArr = $dates->map(fn($date) => Reservation::whereDate('tanggal_reservasi', $date)->count())->toArray();
        $pendingTrend = Reservation::where('status', 'pending')
            ->whereBetween('tanggal_reservasi', [$dates->first(), $dates->last()])
            ->selectRaw('DATE(tanggal_reservasi) as date, COUNT(*) as count')
            ->groupBy('date')
            ->pluck('count', 'date');
        $pendingTrendArr = $dates->map(fn($date) => $pendingTrend[$date] ?? 0)->toArray();
        $cancelledTrend = Reservation::where('status', 'cancelled')
            ->whereBetween('tanggal_reservasi', [$dates->first(), $dates->last()])
            ->selectRaw('DATE(tanggal_reservasi) as date, COUNT(*) as count')
            ->groupBy('date')
            ->pluck('count', 'date');
        $cancelledTrendArr = $dates->map(fn($date) => $cancelledTrend[$date] ?? 0)->toArray();
        $revenueTrend = Reservation::whereIn('status', ['confirmed', 'completed'])
            ->whereYear('tanggal_reservasi', now()->year)
            ->whereBetween('tanggal_reservasi', [$dates->first(), $dates->last()])
            ->selectRaw('DATE(tanggal_reservasi) as date, SUM(harga) as total')
            ->groupBy('date')
            ->pluck('total', 'date');
        $revenueTrendArr = $dates->map(fn($date) => $revenueTrend[$date] ?? 0)->toArray();
        $topServiceTrendArr = $dates->map(fn($date) => Reservation::whereDate('tanggal_reservasi', $date)
            ->where('layanan_id', $topService ? $topService->layanan_id : null)
            ->count())->toArray();

        return [
            Stat::make('Total Reservasi', Reservation::count())
                ->description('Total semua reservasi')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('success')
                // ->chart($totalTrendArr)
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                ]),
            
            Stat::make('Reservasi Hari Ini', Reservation::whereDate('tanggal_reservasi', today())->count())
                ->description('Reservasi untuk hari ini')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('primary')
                // ->chart($todayTrendArr)
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                ]),
            
            Stat::make('Reservasi Pending', Reservation::where('status', 'pending')->count())
                ->description('Reservasi yang belum dikonfirmasi')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning')
                // ->chart($pendingTrendArr)
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                ]),
            
            Stat::make('Reservasi Dibatalkan', Reservation::where('status', 'cancelled')->count())
                ->description('Reservasi yang dibatalkan')
                ->descriptionIcon('heroicon-s-x-circle')
                ->color('danger')
                // ->chart($cancelledTrendArr)
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                ]),
            
            Stat::make('Total Revenue YTD', 'Rp ' . number_format(Reservation::whereYear('tanggal_reservasi', now()->year)
                ->whereIn('status', ['confirmed', 'completed'])
                ->sum('harga'), 0, ',', '.'))
                ->description('Pendapatan tahun ini')
                ->descriptionIcon('heroicon-s-banknotes')
                ->color('primary')
                // ->chart($revenueTrendArr)
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                ]),

            Stat::make('Top Layanan Bulan Ini', $topServiceName )
                ->description('Layanan paling banyak dipesan bulan ini')
                ->descriptionIcon('heroicon-s-star')
                ->color('info')
                ->extraAttributes([
                    'class' => 'cursor-pointer text-sm',
                ])
                
        ];
    }
}
