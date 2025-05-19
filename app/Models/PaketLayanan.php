<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PaketLayanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_paket',
        'slug',
        'harga_paket',
        'deskripsi',
        'image',
        'kategori_id',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($paketLayanan) {
            if (empty($paketLayanan->slug)) {
                $paketLayanan->slug = Str::slug($paketLayanan->nama_paket);
            }
        });
        
        static::updating(function ($paketLayanan) {
            if ($paketLayanan->isDirty('nama_paket')) {
                $paketLayanan->slug = Str::slug($paketLayanan->nama_paket);
            }
        });
    }

    public function layanans()
    {
        return $this->belongsToMany(Layanan::class, 'layanan_paket_layanan');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
