<?php

namespace App\Http\Controllers;

use App\Models\Bayi;
use App\Models\Sesi;
use App\Models\Layanan;
use App\Models\PaketLayanan;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function create($type, $slug)
    {
        if ($type === 'layanan') {
            $service = Layanan::where('slug', $slug)->firstOrFail();
        } else {
            $service = PaketLayanan::where('slug', $slug)->firstOrFail();
        }

        if (!$service) {
            return redirect()->route('layanan.index')->with('error', 'Layanan tidak ditemukan.');
        }

        $bayis = Bayi::where('user_id', Auth::user()->id)->get();
        $sesis = Sesi::orderBy('jam')->get();
        return view('front.reservasi-form', compact('service', 'type', 'sesis', 'bayis'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'type' => 'required|in:layanan,paket',
                'service_id' => 'required',
                'sesi_id' => 'required|exists:sesis,id',
                'nama_bayi' => 'required',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required|in:laki-laki,perempuan',
                'berat_lahir' => 'required|numeric|min:0.5|max:6',
                'berat_sekarang' => 'required|numeric|min:0.5|max:20',
                'save_baby_data' => 'nullable|boolean',
                'terms' => 'required|accepted',
            ], [
                'type.required' => 'Tipe layanan harus dipilih.',
                'type.in' => 'Tipe layanan tidak valid.',
                'service_id.required' => 'Layanan harus dipilih.',
                'tanggal_reservasi.required' => 'Tanggal reservasi harus diisi.',
                'tanggal_reservasi.after' => 'Tanggal reservasi harus setelah hari ini.',
                'sesi_id.required' => 'Sesi harus dipilih.',
                'sesi_id.exists' => 'Sesi tidak valid.',
                'nama_bayi.required' => 'Nama bayi harus diisi.',
                'tanggal_lahir.required' => 'Tanggal lahir bayi harus diisi.',
                'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
                'jenis_kelamin.required' => 'Jenis kelamin harus dipilih.',
                'jenis_kelamin.in' => 'Jenis kelamin tidak valid.',
                'berat_lahir.required' => 'Berat lahir harus diisi.',
                'berat_lahir.numeric' => 'Berat lahir harus berupa angka.',
                'berat_lahir.min' => 'Berat lahir minimal 0.5 kg.',
                'berat_lahir.max' => 'Berat lahir maksimal 6 kg.',
                'berat_sekarang.required' => 'Berat sekarang harus diisi.',
                'berat_sekarang.numeric' => 'Berat sekarang harus berupa angka.',
                'berat_sekarang.min' => 'Berat sekarang minimal 0.5 kg.',
                'berat_sekarang.max' => 'Berat sekarang maksimal 20 kg.',
                'terms.required' => 'Anda harus menyetujui syarat dan ketentuan.',
                'terms.accepted' => 'Anda harus menyetujui syarat dan ketentuan.',
            ]);

            if ($request->type === 'layanan') {
                $service = Layanan::findOrFail($request->service_id);
                $harga = $service->harga_layanan;
            } else {
                $service = PaketLayanan::findOrFail($request->service_id);
                $harga = $service->harga_paket;
            }

            $sesi = Sesi::findOrFail($request->sesi_id);

            // Update user's noHP if it is null
            $user = Auth::user();
            if (is_null($user->noHP)) {
                $user->noHP = $request->noHP;
                $user->save();
            }

            $reservation = new Reservation();
            $reservation->user_id = Auth::user()->id;
            $reservation->layanan_id = $request->service_id;
            $reservation->type = $request->type;
            $reservation->sesi_id = $request->sesi_id;
            $reservation->tanggal_reservasi = $request->tanggal_reservasi;
            $reservation->waktu_reservasi = $sesi->jam;
            $reservation->status = 'pending';
            $reservation->harga = $harga;
            $reservation->catatan = $request->catatan;

            // Always create a baby record, but only set user_id if save_baby_data is checked
            $bayi = new Bayi();
            if ($request->save_baby_data) {
                $bayi->user_id = Auth::user()->id;
            } else {
                // Set a temporary user_id for the reservation
                $bayi->user_id = Auth::user()->id;
            }
            $bayi->nama = $request->nama_bayi;
            $bayi->tanggal_lahir = $request->tanggal_lahir;
            $bayi->jenis_kelamin = $request->jenis_kelamin;
            $bayi->berat_lahir = $request->berat_lahir;
            $bayi->berat_sekarang = $request->berat_sekarang;
            $bayi->save();

            $reservation->bayi_id = $bayi->id;
            $reservation->save();

            DB::commit();

            // Store necessary data in session for payment page
            session([
                'reservation_id' => $reservation->id,
                'service_name' => $service->nama_layanan ?? $service->nama_paket,
                'service_price' => $harga,
                'parent_name' => Auth::user()->name,
                'baby_name' => $request->nama_bayi,
                'phone' => Auth::user()->noHP,
                'email' => Auth::user()->email
            ]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'redirect' => route('payment.show', $reservation)
                ]);
            }
            return redirect()->route('payment.show', $reservation);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Reservation error: ' . $e->getMessage());
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat membuat reservasi.'
                ], 400);
            }
            return back()->withInput()->with('error', 'Terjadi kesalahan saat membuat reservasi. Silakan coba lagi.');
        }
    }

    public function success()
    {
        return view('front.reservasi-success');
    }

    public function showPayment(Reservation $reservation)
    {
        // Check if the reservation belongs to the authenticated user
        if ($reservation->user_id !== Auth::id()) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke reservasi ini.');
        }

        return view('front.pembayaran', compact('reservation'));
    }
} 