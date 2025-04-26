<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = [
        'nama_layanan',
        'harga_layanan',
        'deskripsi',
        'image',
        'kategori_id',
    ];

    public function getImageAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function paketLayanans()
    {
        return $this->belongsToMany(PaketLayanan::class, 'layanan_paket_layanan');
    }
}
