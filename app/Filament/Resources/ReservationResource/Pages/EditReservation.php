<?php

namespace App\Filament\Resources\ReservationResource\Pages;

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

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $record = $this->record->fresh();
        $original = $this->record->getOriginal();
        
        // Log untuk debugging
        Log::info('Original data:', $original);
        Log::info('New data:', $record->toArray());
        
        // Check if tanggal_reservasi or sesi_id has changed
        if ($original['tanggal_reservasi'] !== $record->tanggal_reservasi || 
            $original['sesi_id'] !== $record->sesi_id) {
            
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
            
            // Log notification sent
            Log::info('Notification sent to customer:', [
                'customer_id' => $customer->id,
                'new_date' => $formattedDate,
                'new_time' => $newSesiTime
            ]);
        }
    }
}
