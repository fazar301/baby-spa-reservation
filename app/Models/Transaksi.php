<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis';

    protected $fillable = [
        'reservasi_id',
        'tanggal',
        'jumlah',
        'discount_amount',
        'status',
        'metode',
    ];

    protected $casts = [
        'tanggal' => 'datetime',
        'jumlah' => 'decimal:2',
        'discount_amount' => 'decimal:2',
    ];

    public function reservasi()
    {
        return $this->belongsTo(Reservation::class, 'reservasi_id');
    }
} 