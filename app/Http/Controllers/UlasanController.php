<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UlasanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'reservation_code' => 'required|exists:reservasis,kode',
            'service_name' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'nullable|string|max:1000',
        ]);

        $reservasi = Reservasi::where('kode', $request->reservation_code)->firstOrFail();

        // Check if user owns this reservation
        if ($reservasi->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Check if review already exists
        if ($reservasi->ulasan) {
            return response()->json(['message' => 'Review already exists for this reservation'], 422);
        }

        // Create the review
        $ulasan = Ulasan::create([
            'reservasis_id' => $reservasi->id,
            'user_id' => Auth::id(),
            'nama_layanan' => $request->service_name,
            'rating' => $request->rating,
            'feedback' => $request->review_text,
        ]);

        return response()->json(['message' => 'Review submitted successfully', 'data' => $ulasan]);
    }
} 