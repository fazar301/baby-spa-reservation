<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Transaksi;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BatalkanTransaksiMidtransTimeout extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transaksi:batalkan-timeout';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Membatalkan transaksi Midtrans yang timeout setelah 30 menit';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            DB::beginTransaction();

            // Ambil semua transaksi pending yang lebih dari 30 menit
            $expiredTransactions = Transaksi::where('status', 'pending')
                ->where('metode', 'midtrans')
                ->where('created_at', '<=', Carbon::now()->subMinutes(30))
                ->get();

            $count = 0;
            foreach ($expiredTransactions as $transaction) {
                // Update status transaksi menjadi expired
                $transaction->status = 'expired';
                $transaction->save();

                // Update status reservasi menjadi cancelled
                $reservation = Reservation::find($transaction->reservasi_id);
                if ($reservation) {
                    $reservation->status = 'cancelled';
                    $reservation->save();
                }

                $count++;
            }

            DB::commit();

            $this->info("Berhasil membatalkan {$count} transaksi yang timeout.");
            Log::info("BatalkanTransaksiMidtransTimeout: {$count} transaksi dibatalkan");

        } catch (\Exception $e) {
            DB::rollBack();
            $this->error("Terjadi kesalahan: " . $e->getMessage());
            Log::error("BatalkanTransaksiMidtransTimeout error: " . $e->getMessage());
        }
    }
}
