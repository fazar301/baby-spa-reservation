<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UpdateReservationStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reservasi:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update reservation status to complete for past sessions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $reservations = Reservation::with('sesi')
                ->where('status', 'confirmed')
                ->get();

            $updatedCount = 0;

            foreach ($reservations as $reservation) {
                $sesiDateTime = Carbon::parse($reservation->tanggal_reservasi->format('Y-m-d') . ' ' . $reservation->sesi->jam);
                $isPast = now()->gt($sesiDateTime->addHour());

                if ($isPast) {
                    $reservation->status = 'completed';
                    $reservation->save();
                    $updatedCount++;
                }
            }

            $this->info("Successfully updated {$updatedCount} reservations to complete status.");
            Log::info("Reservation status update completed. Updated {$updatedCount} reservations.");
        } catch (\Exception $e) {
            $this->error("Error updating reservation status: " . $e->getMessage());
            Log::error("Error in UpdateReservationStatus command: " . $e->getMessage());
        }
    }
}
