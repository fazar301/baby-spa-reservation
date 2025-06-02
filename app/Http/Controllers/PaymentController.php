<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaksi;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Notification as LaravelNotification;
use App\Notifications\ReservationNotification;

class PaymentController extends Controller
{
    public function verify(Request $request)
    {
        try {
            $result = $request->all();
            Log::info('Payment verification result:', $result);

            DB::beginTransaction();

            // Get transaction using order_id from Midtrans response
            $transaction = Transaksi::where('order_id', $result['order_id'])->first();
            
            if (!$transaction) {
                Log::error('Transaction not found for order_id: ' . $result['order_id']);
                return response()->json([
                    'success' => false,
                    'message' => 'Transaction not found'
                ], 404);
            }

            // Update transaction status based on Midtrans response
            if ($result['transaction_status'] === 'settlement') {
                $transaction->status = 'paid';
                
                // Update reservation status to confirmed
                $reservation = Reservation::find($transaction->reservasi_id);
                if ($reservation) {
                    $reservation->status = 'confirmed';
                    $reservation->save();
                    
                    // Send notification to admin using Filament
                    $customer = Auth::user();
                    $admin = User::where('role', 'admin')->first();
                    Notification::make()
                        ->title('Reservasi Baru Diterima')
                        ->body('Pelanggan ' . $customer->name . ' telah melakukan reservasi untuk hari ' . \Carbon\Carbon::parse($reservation->tanggal_reservasi)->locale('id')->isoFormat('dddd, D MMMM Y') . ' pada jam ' . substr($reservation->sesi->jam, 0, 5) . '. Silakan cek detail reservasi.')
                        ->sendToDatabase($admin);

                    // Send notification to customer using Laravel Notification
                    $customer->notify(new ReservationNotification(
                        'Reservasi Dikonfirmasi',
                        'Reservasi baby spa untuk anak Anda telah dikonfirmasi',
                        'success'
                    ));
                }
            } else {
                $transaction->status = $result['transaction_status'];
            }
            $transaction->metode = $result['payment_type'];
            $transaction->save();

            DB::commit();

            Log::info('Transaction and reservation updated successfully', [
                'transaction_id' => $transaction->id,
                'order_id' => $result['order_id'],
                'status' => $result['transaction_status']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Payment verified successfully',
                'status' => $result['transaction_status']
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment verification error: ' . $e->getMessage(), [
                'exception' => $e,
                'request_data' => $request->all()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to verify payment'
            ], 500);
        }
    }

    public function handleNotification(Request $request)
    {
        try {
            $payload = $request->all();
            Log::info('Midtrans notification:', $payload);

            $transaction = Transaksi::where('snap_token', $payload['snap_token'])->first();
            
            if (!$transaction) {
                return response()->json([
                    'success' => false,
                    'message' => 'Transaction not found'
                ], 404);
            }

            // Update transaction status and payment method
            $transaction->status = $payload['transaction_status'];
            if (isset($payload['payment_type'])) {
                $transaction->metode = $payload['payment_type'];
            }
            $transaction->save();

            // For QRIS payments, we need to handle the payment status differently
            if ($payload['payment_type'] === 'qris') {
                if ($payload['transaction_status'] === 'settlement') {
                    // Payment is successful
                    return response()->json([
                        'success' => true,
                        'message' => 'Payment successful'
                    ]);
                } elseif ($payload['transaction_status'] === 'pending') {
                    // Payment is pending
                    return response()->json([
                        'success' => true,
                        'message' => 'Payment pending'
                    ]);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Notification received'
            ]);

        } catch (\Exception $e) {
            Log::error('Payment notification error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to process notification'
            ], 500);
        }
    }

    public function cancel(Request $request)
    {
        try {
            DB::beginTransaction();

            $snapToken = $request->snap_token;
            $transaction = Transaksi::where('snap_token', $snapToken)->first();

            if (!$transaction) {
                return response()->json([
                    'success' => false,
                    'message' => 'Transaction not found'
                ], 404);
            }

            // Delete the transaction
            $transaction->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Transaction cancelled successfully'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment cancellation error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to cancel transaction'
            ], 500);
        }
    }

    public function setPendingStatus(Request $request)
    {
        try {
            DB::beginTransaction();

            $snapToken = $request->snap_token;
            $transaction = Transaksi::where('snap_token', $snapToken)->first();

            if (!$transaction) {
                return response()->json([
                    'success' => false,
                    'message' => 'Transaction not found'
                ], 404);
            }

            // Update status to pending
            if ($transaction->status === 'pending') {
                // If already pending, no need to update
                DB::commit();
                return response()->json([
                    'success' => true,
                    'message' => 'Transaction is already pending'
                ]);
            } else if ($transaction->status !== 'paid' && $transaction->status !== 'failed') {
                $transaction->status = 'pending';
                $transaction->save();

                // Optionally update reservation status if needed, but be careful not to overwrite 'confirmed'
                $reservation = $transaction->reservasi;
                if ($reservation && $reservation->status !== 'confirmed') {
                    $reservation->status = 'pending'; // Or another appropriate status like 'created'
                    $reservation->save();
                }

                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Transaction status updated to pending'
                ]);
            } else {
                // Status is already paid or failed, do nothing
                DB::commit();
                return response()->json([
                    'success' => false,
                    'message' => 'Transaction status is final, cannot set to pending'
                ]);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment set pending error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to set transaction status to pending'
            ], 500);
        }
    }
} 