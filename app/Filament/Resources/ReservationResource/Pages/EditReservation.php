<?php

namespace App\Filament\Resources\ReservationResource\Pages;

use Carbon\Carbon;
use App\Models\Sesi;
use Filament\Actions;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Filament\Resources\Pages\EditRecord;
use App\Notifications\ReservationNotification;
use App\Filament\Resources\ReservationResource;

class EditReservation extends EditRecord
{
    protected static string $resource = ReservationResource::class;

    protected $originalDate;
    protected $originalSesi;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function beforeSave(): void
    {
        // Store original values before save
        $this->originalDate = $this->record->getOriginal('tanggal_reservasi');
        $this->originalSesi = $this->record->getOriginal('sesi_id');
    }

    protected function afterSave(): void
    {
        $record = $this->record->fresh();
        
        // Compare dates using direct string comparison
        $originalDateStr = Carbon::parse($this->originalDate)->format('Y-m-d');
        $newDateStr = Carbon::parse($record->tanggal_reservasi)->format('Y-m-d');
        $isDateChanged = $originalDateStr !== $newDateStr;
        $isSesiChanged = $this->originalSesi != $record->sesi_id;

        
        if ($isDateChanged || $isSesiChanged) {
            
            // Get the session time
            $newSesiTime = Str::substr(Sesi::find($record->sesi_id)->jam,0,5);
            
            // Format the date
            $formattedDate = \Carbon\Carbon::parse($record->tanggal_reservasi)->format('d M Y');
            
            // Send notification to customer
            $customer = $record->user;
            $customer->notify(new ReservationNotification(
                'Reservasi Diubah',
                "Reservasi Anda telah diubah ke tanggal {$formattedDate} pada pukul {$newSesiTime}",
                'warning'
            ));
            
        }
    }
    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }
}
