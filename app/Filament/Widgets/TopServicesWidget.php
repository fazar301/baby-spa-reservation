<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;

class TopServicesWidget extends Widget
{
    protected static string $view = 'filament.widgets.top-services-widget';
    protected int | string | array $columnSpan = 1;

    public $topServices = [];

    public function mount()
    {
        $this->topServices = Reservation::select('layanan_id', DB::raw('count(*) as total'))
            ->whereMonth('tanggal_reservasi', now()->month)
            ->whereYear('tanggal_reservasi', now()->year)
            ->groupBy('layanan_id')
            ->orderByDesc('total')
            ->with('layanan')
            ->take(3)
            ->get();
    }
} 