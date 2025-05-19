<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Baby extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'birthdate',
        'gender',
        'birth_weight',
        'current_weight',
    ];

    protected $casts = [
        'birthdate' => 'date',
        'birth_weight' => 'decimal:2',
        'current_weight' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function getAgeAttribute()
    {
        $birthdate = $this->birthdate;
        $today = now();
        
        $years = $today->diffInYears($birthdate);
        $months = $today->diffInMonths($birthdate) % 12;
        
        if ($years > 0) {
            return $years . ' tahun' . ($months > 0 ? ' ' . $months . ' bulan' : '');
        }
        
        return $months . ' bulan';
    }
} 