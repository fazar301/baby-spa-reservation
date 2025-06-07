<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Holiday extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal_mulai',
        'tanggal_selesai',
        'deskripsi',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function getAffectedReservations()
    {
        return \App\Models\Reservation::whereBetween('tanggal_reservasi', [
            $this->tanggal_mulai,
            $this->tanggal_selesai
        ])->get();
    }
}
