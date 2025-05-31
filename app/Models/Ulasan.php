<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ulasan extends Model
{
    protected $fillable = [
        'reservasis_id',
        'user_id',
        'nama_layanan',
        'rating',
        'feedback'
    ];

    public function reservasi(): BelongsTo
    {
        return $this->belongsTo(Reservasi::class, 'reservasis_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
