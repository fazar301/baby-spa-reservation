<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\PaketLayanan;
use App\Models\Reservation;
use App\Models\Transaksi;
use App\Models\Bayi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get total visits (completed reservations)
        $totalVisits = Reservation::where('user_id', $user->id)
            ->where('status', 'confirmed')
            ->count();
            
        // Get visits this month
        $visitsThisMonth = Reservation::where('user_id', $user->id)
            ->where('status', 'confirmed')
            ->whereMonth('tanggal_reservasi', Carbon::now()->month)
            ->count();
            
        // Get total spending
        $totalSpending = Transaksi::whereHas('reservasi', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->where('status', 'paid')
            ->sum('jumlah');
            
        // Get registered children
        $registeredChildren = Bayi::where('user_id', $user->id)
            ->where('is_temporary', false)
            ->count();
            
        // Get favorite service
        $favoriteService = Reservation::where('user_id', $user->id)
            ->where('status', 'confirmed')
            ->select('layanan_id', \DB::raw('count(*) as total'))
            ->groupBy('layanan_id')
            ->orderBy('total', 'desc')
            ->first();
            
        $favoriteServiceName = $favoriteService ? 
            ($favoriteService->layanan ? $favoriteService->layanan->nama_layanan : 'Belum ada') : 
            'Belum ada';
            
        // Get the count of visits for the favorite service
        $favoriteServiceVisitsCount = $favoriteService ? $favoriteService->total : 0;
            
        // Get upcoming reservations
        $upcomingReservations = Reservation::where('user_id', $user->id)
        ->where('status', 'confirmed')
        ->with(['layanan', 'bayi', 'sesi'])
        ->get()
        ->filter(function ($reservation) {
            $reservationDateTime = Carbon::parse($reservation->tanggal_reservasi->format('Y-m-d') . ' ' . $reservation->sesi->jam);
            return now()->lte($reservationDateTime->addHour()); // not yet passed
        })
        ->sortBy('tanggal_reservasi')
        ->take(3);

            
        // Get recent transactions
        $recentTransactions = Transaksi::whereHas('reservasi', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->where('status', 'paid')
            ->with(['reservasi.layanan'])
            ->orderBy('tanggal', 'desc')
            ->limit(3)
            ->get();
            
        // Get children profiles with total sessions and last visit date
        $children = Bayi::where('bayis.user_id', $user->id)
            ->where('is_temporary', false)
            ->leftJoin('reservasis', 'bayis.id', '=', 'reservasis.bayi_id') // Assuming 'bayi_id' foreign key in reservasis
            ->select(
                'bayis.*', // Select all original bayi columns
                \DB::raw('COUNT(reservasis.id) as total_sessions'), // Count reservasis
                \DB::raw('MAX(reservasis.tanggal_reservasi) as last_visit_date') // Get the latest reservation date
            )
            ->groupBy('bayis.id', 'bayis.user_id', 'bayis.berat_lahir', 'bayis.berat_sekarang', 'bayis.nama', 'bayis.tanggal_lahir', 'bayis.jenis_kelamin', 'bayis.is_temporary', 'bayis.created_at', 'bayis.updated_at') // Group by all original bayi columns
            ->get();
            
        return view('dashboard_user.home', compact(
            'totalVisits',
            'visitsThisMonth',
            'totalSpending',
            'registeredChildren',
            'favoriteServiceName',
            'upcomingReservations',
            'recentTransactions',
            'children',
            'favoriteServiceVisitsCount'
        ));
    }

    public function create()
    {
        $layanans = Layanan::all();
        $paketLayanans = PaketLayanan::all();
        return view('dashboard_user.create_reservasi', compact('layanans', 'paketLayanans'));
    }
} 