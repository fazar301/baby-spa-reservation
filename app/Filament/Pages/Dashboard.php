<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets;

class Dashboard extends BaseDashboard
{
    public function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Widgets\ReservationStats::class,
            \App\Filament\Widgets\RevenueChart::class,
            \App\Filament\Widgets\ReservationsChart::class,
        ];
    }

    public function getWidgets(): array
    {
        return [
            \App\Filament\Widgets\LatestReservations::class,
        ];
    }
}