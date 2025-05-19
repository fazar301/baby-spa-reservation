<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Layanan extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    protected $casts = [
        'manfaat' => 'array',
    ];

    protected $fillable = [
        'nama_layanan',
        'slug',
        'harga_layanan',
        'deskripsi',
        'image',
        'kategori_id',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($layanan) {
            if (empty($layanan->slug)) {
                $layanan->slug = Str::slug($layanan->nama_layanan);
            }
        });
        
        static::updating(function ($layanan) {
            if ($layanan->isDirty('nama_layanan')) {
                $layanan->slug = Str::slug($layanan->nama_layanan);
            }
        });
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
