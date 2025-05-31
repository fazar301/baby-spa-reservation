<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Reservasi extends Model
{
    protected $table = 'reservasis';

    protected $fillable = [
        'user_id',
        'layanan_id',
        'type',
        'sesi_id',
        'bayi_id',
        'tanggal_reservasi',
        'waktu_reservasi',
        'status',
        'harga',
        'catatan',
    ];

    protected $casts = [
        'tanggal_reservasi' => 'date',
        'harga' => 'decimal:2',
    ];

    public function ulasan(): HasOne
    {
        return $this->hasOne(Ulasan::class, 'reservasis_id');
    }
}
