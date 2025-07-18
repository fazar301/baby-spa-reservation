<?php

namespace App\Filament\Resources\VoucherResource\Pages;

use App\Filament\Resources\VoucherResource;
use Filament\Resources\Pages\ListRecords;

class ListVouchers extends ListRecords
{
    protected static string $resource = VoucherResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Pages\Actions\CreateAction::make(),
        ];
    }
} 