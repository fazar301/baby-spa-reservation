<?php

namespace Database\Seeders;

use App\Models\PaketLayanan;
use App\Models\Layanan;
use Illuminate\Database\Seeder;

class PaketLayananSeeder extends Seeder
{
    public function run(): void
    {
        // Create 5 paket records
        $pakets = PaketLayanan::factory()->count(5)->create();

        // Attach 2-4 random layanans to each paket
        foreach ($pakets as $paket) {
            $layanans = Layanan::inRandomOrder()->take(rand(2, 4))->get();
            $paket->layanans()->attach($layanans);
        }
    }
} 