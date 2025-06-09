<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Midtrans\Snap;
use App\Models\User;
use Midtrans\Config;
use App\Models\Voucher;
use App\Models\Transaksi;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Session;
use App\Notifications\PaymentSuccessNotification;

class TransaksiController extends Controller
{
    public function __construct()
    {
        // Set Midtrans configuration
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        Config::$isSanitized = env('MIDTRANS_IS_SANITIZE');
        Config::$is3ds = env('MIDTRANS_IS_3DS');
    }

    // Show payment form
    public function showPayment(Reservation $reservation)
    {
        if ($reservation->user_id !== Auth::id()) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke reservasi ini.');
        }
        $reservationId = Session::get('reservation_id');
        if($reservationId){
            $reservation = Reservation::find($reservationId);
            if($reservation->status == 'confirmed'){
                return redirect('/reservasi/success');
            }
        }
        return view('front.pembayaran', compact('reservation'));
    }

    // Apply voucher (AJAX or POST)
    public function applyVoucher(Request $request, Reservation $reservation)
    {
        $voucher = Voucher::where('code', $request->voucher_code)->first();
        if (!$voucher || !$voucher->isValid()) {
            return response()->json(['success' => false, 'message' => 'Voucher tidak valid atau sudah tidak aktif.']);
        }
        $discount = $voucher->calculateDiscount($reservation->harga);
        return response()->json([
            'success' => true,
            'discount' => $discount,
            'final_amount' => $reservation->harga - $discount,
            'voucher_id' => $voucher->id,
        ]);
    }

    // Process payment and create transaction
    public function processPayment(Request $request)
    {
        $request->validate([
            'reservation_id' => 'required|exists:reservasis,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
            'discount_amount' => 'nullable|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();
            $reservation = Reservation::findOrFail($request->reservation_id);
            
            if ($reservation->user_id !== Auth::id()) {
                return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke reservasi ini.');
            }

            // Check for existing pending or failed transaction for this reservation
            $transaksi = Transaksi::where('reservasi_id', $reservation->id)
                                ->whereIn('status', ['pending', 'failed'])
                                ->first();

            if ($transaksi) {
                // Update existing transaction
                $transaksi->tanggal = Carbon::now();
                $transaksi->jumlah = $request->amount;
                $transaksi->discount_amount = $request->discount_amount ?? 0;
                $transaksi->status = 'pending'; // Reset status to pending
                $transaksi->metode = $request->payment_method;
                // Do NOT update snap_token or order_id here, they will be generated again below
            } else {
                // Create new transaction record
                $transaksi = new Transaksi();
                $transaksi->reservasi_id = $reservation->id;
                $transaksi->tanggal = Carbon::now();
                $transaksi->jumlah = $request->amount;
                $transaksi->discount_amount = $request->discount_amount ?? 0;
                $transaksi->status = 'pending';
                $transaksi->metode = $request->payment_method;
            }

            $transaksi->save();

            // Prepare Midtrans transaction parameters
            $params = [
                'transaction_details' => [
                    'order_id' => 'ORDER-' . $transaksi->id . '-' . time(),
                    'gross_amount' => (int) $request->amount,
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'phone' => Auth::user()->phone ?? '',
                ],
                'item_details' => [
                    [
                        'id' => $reservation->id,
                        'price' => (int) $request->amount,
                        'quantity' => 1,
                        'name' => 'Reservasi Baby Spa',
                    ],
                ],
            ];

            // Get Snap Token
            $snapToken = Snap::getSnapToken($params);

            // Update transaction with snap token and order_id
            $transaksi->snap_token = $snapToken;
            $transaksi->order_id = $params['transaction_details']['order_id'];
            $transaksi->save();

            DB::commit();

            if($transaksi->metode == 'cash'){
                // Send notification to admin
                $customer = Auth::user();
                $admin = User::where('role', 'admin')->first();
                Notification::make()
                    ->title('Reservasi Baru Diterima')
                    ->body('Pelanggan ' . $customer->name . ' telah melakukan reservasi untuk hari ' . \Carbon\Carbon::parse($reservation->tanggal_reservasi)->locale('id')->isoFormat('dddd, D MMMM Y') . ' pada jam ' . substr($reservation->sesi->jam, 0, 5) . '. Silakan cek detail reservasi.')
                    ->sendToDatabase($admin);

                // Send email notification to customer
                $customer->notify(new PaymentSuccessNotification($reservation, $transaksi));
            }
            return response()->json([
                'success' => true,
                'snap_token' => $snapToken,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memproses pembayaran.'
            ], 500);
        }
    }

    // Add callback handler for Midtrans
    public function handleCallback(Request $request)
    {
        $payload = $request->all();
        
        try {
            DB::beginTransaction();
        
        $orderId = explode('-', $payload['order_id'])[1];
        $transaksi = Transaksi::findOrFail($orderId);
        
        $transactionStatus = $payload['transaction_status'];
        $fraudStatus = $payload['fraud_status'];

        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'challenge') {
                $transaksi->status = 'challenge';
            } else if ($fraudStatus == 'accept') {
                $transaksi->status = 'paid';
                    // Update reservation status
                    $reservation = Reservation::find($transaksi->reservasi_id);
                    if ($reservation) {
                        $reservation->status = 'confirmed';
                        $reservation->save();
                    }
            }
        } else if ($transactionStatus == 'settlement') {
            $transaksi->status = 'paid';
                // Update reservation status
                $reservation = Reservation::find($transaksi->reservasi_id);
                if ($reservation) {
                    $reservation->status = 'confirmed';
                    $reservation->save();
                }
        } else if ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire') {
            $transaksi->status = 'failed';
        } else if ($transactionStatus == 'pending') {
            $transaksi->status = 'pending';
        }

        $transaksi->save();
        
            DB::commit();
        return response()->json(['success' => true]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Callback error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to process callback'], 500);
        }
    }
} 