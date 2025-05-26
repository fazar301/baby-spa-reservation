<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Bayi;
use App\Models\Sesi;
use App\Models\Layanan;
use App\Models\Reservation;
use App\Models\PaketLayanan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

        $bayis = Bayi::where('user_id', Auth::user()->id)
            ->where('is_temporary', false)
            ->get();

        // Get all sessions
        $allSesis = Sesi::orderBy('jam')->get();
        
        // Get today's date
        $today = now()->format('Y-m-d');
        
        // Get all reservations for the next 7 days
        $reservations = Reservation::where('tanggal_reservasi', '>=', $today)
            ->where('tanggal_reservasi', '<=', now()->addDays(7)->format('Y-m-d'))
            ->get()
            ->groupBy(function($reservation) {
                return $reservation->tanggal_reservasi . '_' . $reservation->sesi_id;
            });

        // Filter out sessions that are already booked
        $sesis = $allSesis->filter(function($sesi) use ($reservations) {
            // For each date in the next 7 days
            for ($i = 0; $i < 7; $i++) {
                $date = now()->addDays($i)->format('Y-m-d');
                $key = $date . '_' . $sesi->id;
                
                // If this session is not booked for this date, it's available
                if (!isset($reservations[$key])) {
                    return true;
                }
            }
            return false;
        });

        return view('front.reservasi-form', compact('service', 'type', 'sesis', 'bayis'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Calculate baby's age
            $tanggal_lahir = \Carbon\Carbon::parse($request->tanggal_lahir);
            $umur_bayi = $tanggal_lahir->age;
            $umur_bayi_bulan = $tanggal_lahir->diffInMonths(now());

            // Get service and validate age
            if ($request->type === 'layanan') {
                $service = Layanan::with('kategori')->findOrFail($request->service_id);
            } else {
                $service = PaketLayanan::with('kategori')->findOrFail($request->service_id);
            }

            // Validate age based on service category
            if ($service->kategori) {
                $is_valid_age = false;
                switch ($service->kategori->nama_kategori) {
                    case 'Baby':
                        if ($umur_bayi_bulan <= 12) {
                            $is_valid_age = true;
                        }
                        break;
                    case 'Kids':
                        if ($umur_bayi >= 1 && $umur_bayi <= 3) {
                            $is_valid_age = true;
                        }
                        break;
                    case 'Children':
                        if ($umur_bayi >= 3) {
                            $is_valid_age = true;
                        }
                        break;
                }

                if (!$is_valid_age) {
                    if ($request->ajax() || $request->wantsJson()) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Umur bayi tidak sesuai dengan persyaratan layanan yang dipilih.'
                        ], 422);
                    }
                    return back()->withInput()->with('error', 'Umur bayi tidak sesuai dengan persyaratan layanan yang dipilih.');
                }
            }

            $validator = Validator::make($request->all(), [
                'type' => 'required|in:layanan,paket',
                'service_id' => 'required',
                'sesi_id' => 'required|exists:sesis,id',
                'nama_bayi' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date|before_or_equal:today',
                'jenis_kelamin' => 'required|in:laki-laki,perempuan',
                'berat_lahir' => 'required|numeric|min:0.5|max:6',
                'berat_sekarang' => 'required|numeric|min:0.5|max:20',
                'save_baby_data' => 'nullable|boolean',
                'terms' => 'required|accepted',
                'parent_name' => 'required|string|max:255',
                'noHP' => 'required|string|max:20|unique:users,noHP,' . Auth::id(),
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
                'tanggal_lahir.before_or_equal' => 'Tanggal lahir tidak boleh lebih dari hari ini.',
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
                'parent_name.required' => 'Nama orang tua harus diisi.',
                'noHP.required' => 'Nomor telepon harus diisi.',
                'noHP.unique' => 'Nomor telepon ini sudah digunakan oleh pengguna lain.',
            ]);

            if ($validator->fails()) {
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Validasi gagal',
                        'errors' => $validator->errors()
                    ], 422);
                }
                return back()->withErrors($validator)->withInput();
            }

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
                $bayi->is_temporary = true;
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
        // Retrieve reservation ID from session
        $reservationId = Session::get('reservation_id');

        $reservation = null;
        if ($reservationId) {
            // Fetch the reservation with necessary relationships
            $reservation = Reservation::with(['user', 'layanan', 'paketLayanan', 'bayi'])->find($reservationId);

            // Optionally, clear the reservation_id from session after retrieving
            // Session::forget('reservation_id');
        }

        // Pass the reservation object to the view
        return view('front.reservasi-success', compact('reservation'));
    }

    public function downloadInvoice(Reservation $reservation)
    {
        // Load any related data needed for the invoice (user, service/package, etc.)
        $reservation->load(['user', 'layanan', 'paketLayanan', 'bayi']); // Adjust relationships as needed

        // Create a dedicated Blade view for the invoice PDF
        $pdf = Pdf::loadView('pdf.invoice', compact('reservation'));

        // Download the PDF
        return $pdf->download('invoice_' . $reservation->id . '.pdf');
    }

    public function showPayment(Reservation $reservation)
    {
        // Check if the reservation belongs to the authenticated user
        if ($reservation->user_id !== Auth::id()) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke reservasi ini.');
        }

        return view('front.pembayaran', compact('reservation'));
    }
    
    public function pending()
    {
        return view('front.pending-payment', [
            'title' => 'Pembayaran Pending'
        ]);
    }

    public function index()
    {
        $reservations = Reservation::where('user_id', Auth::id())
            ->with(['layanan', 'paketLayanan', 'bayi', 'sesi'])
            ->orderBy('created_at', 'desc')
            ->get();
        $layanans = Layanan::all();
        $paketLayanans = PaketLayanan::all();
        return view('dashboard_user.reservasi', [
            'reservations' => $reservations,
            'layanans' => $layanans,
            'paketLayanans' => $paketLayanans,
            'title' => 'Daftar Reservasi'
        ]);
    }

    public function getAvailableSessions(Request $request)
    {
        $date = $request->query('date');
        
        if (!$date) {
            return response()->json(['error' => 'Date is required'], 400);
        }

        // Get all sessions
        $allSesis = Sesi::orderBy('jam')->get();
        
        // Get reservations for the specific date
        $bookedSessions = Reservation::where('tanggal_reservasi', $date)
            ->pluck('sesi_id')
            ->toArray();
        
        // Filter out booked sessions
        $availableSessions = $allSesis->filter(function($sesi) use ($bookedSessions) {
            return !in_array($sesi->id, $bookedSessions);
        })->pluck('id')->toArray();

        return response()->json([
            'available_sessions' => $availableSessions
        ]);
    }
} 