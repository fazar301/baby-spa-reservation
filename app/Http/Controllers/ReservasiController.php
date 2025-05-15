<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Layanan;
use App\Models\Sesi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservasiController extends Controller
{
    public function create()
    {
        $layanans = Layanan::all();
        $sesis = Sesi::all();
        return view('dashboard_user.create_reservasi', compact('layanans', 'sesis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'layanan_id' => 'required|exists:layanans,id',
            'sesi_id' => 'required|exists:sesis,id',
            'catatan' => 'nullable|string|max:255',
        ]);

        $reservasi = new Reservasi();
        $reservasi->user_id = Auth::id();
        $reservasi->layanan_id = $request->layanan_id;
        $reservasi->sesi_id = $request->sesi_id;
        $reservasi->status = 'menunggu';
        $reservasi->catatan = $request->catatan;
        $reservasi->save();

        return redirect()->route('reservasi')->with('success', 'Reservasi berhasil dibuat!');
    }
} 