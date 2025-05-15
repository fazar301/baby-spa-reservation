<?php

namespace Database\Factories;

use App\Models\PaketLayanan;
use App\Models\Kategori;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaketLayananFactory extends Factory
{
    protected $model = PaketLayanan::class;

    public function definition(): array
    {
        $paketNames = [
            'Paket Baby Spa Premium',
            'Paket Baby Care Complete',
            'Paket Baby Wellness',
            'Paket Baby Relaxation',
            'Paket Baby Development',
            'Paket Baby Health',
            'Paket Baby Growth',
            'Paket Baby Comfort',
            'Paket Baby Balance',
            'Paket Baby Harmony'
        ];

        // Get a random kategori or create one if none exists
        $kategori = Kategori::inRandomOrder()->first() ?? Kategori::create(['nama_kategori' => 'Baby']);

        return [
            'nama_paket' => $this->faker->unique()->randomElement($paketNames),
            'harga_paket' => $this->faker->numberBetween(500000, 2000000),
            'deskripsi' => $this->faker->paragraph(3),
            'image' => 'default-paket.jpg',
            'kategori_id' => $kategori->id,
        ];
    }
} 