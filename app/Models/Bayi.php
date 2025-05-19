<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bayi extends Model
{
    use HasFactory;

    protected $table = 'bayis';

    protected $fillable = [
        'user_id',
        'nama',
        'tanggal_lahir',
        'jenis_kelamin',
        'berat_lahir',
        'berat_sekarang',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'berat_lahir' => 'decimal:2',
        'berat_sekarang' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reservasis()
    {
        return $this->hasMany(Reservation::class);
    }
} 