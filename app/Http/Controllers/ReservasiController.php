<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Layanan;
use App\Models\Sesi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservasiController extends Controller
{
    // Remove the create and store methods from this controller.

    public function pending()
    {
        return view('front.pending-payment', [
            'title' => 'Pembayaran Pending'
        ]);
    }
} 