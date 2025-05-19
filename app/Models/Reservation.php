<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Layanan::class, 'layanan_id');
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanan_id');
    }

    public function paketLayanan()
    {
        return $this->belongsTo(PaketLayanan::class, 'layanan_id');
    }

    public function sesi()
    {
        return $this->belongsTo(Sesi::class);
    }

    public function bayi()
    {
        return $this->belongsTo(Bayi::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }
} 