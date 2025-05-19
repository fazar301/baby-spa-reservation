<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\PaketLayanan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $layanans = Layanan::all();
        $paketLayanans = PaketLayanan::all();
        return view('dashboard_user.reservasi', compact('layanans', 'paketLayanans'));
    }

    public function create()
    {
        $layanans = Layanan::all();
        $paketLayanans = PaketLayanan::all();
        return view('dashboard_user.create_reservasi', compact('layanans', 'paketLayanans'));
    }
} 