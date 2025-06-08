<?php

namespace App\Filament\Widgets;

use App\Models\Reservation;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ReservationStats extends BaseWidget
{
    protected static ?int $sort = 1;
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        return [
            Stat::make('Total Reservasi', Reservation::count())
                ->description('Total semua reservasi')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('success')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3])
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                ]),
            
            Stat::make('Reservasi Hari Ini', Reservation::whereDate('tanggal_reservasi', today())->count())
                ->description('Reservasi untuk hari ini')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('primary')
                ->chart([3, 5, 3, 4, 5, 6, 3, 5])
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                ]),
            
            Stat::make('Reservasi Pending', Reservation::where('status', 'pending')->count())
                ->description('Reservasi yang belum dikonfirmasi')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning')
                ->chart([5, 3, 4, 5, 6, 3, 5, 3])
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                ]),
        ];
    }
}
