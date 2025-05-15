<?php

namespace Database\Factories;

use App\Models\Layanan;
use App\Models\Kategori;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Layanan>
 */
class LayananFactory extends Factory
{
    protected $model = Layanan::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $layananNames = [
            'Pijat Bayi',
            'Hidroterapi',
            'Sesi Mengambang',
            'Baby Swim',
            'Baby Gym',
            'Pijat Refleksi',
            'Aromaterapi',
            'Sensory Play',
            'Baby Yoga',
            'Baby Massage'
        ];

        $manfaat = [
            ['value' => 'Meningkatkan kualitas tidur'],
            ['value' => 'Memperkuat ikatan orang tua-anak'],
            ['value' => 'Membantu perkembangan saraf'],
            ['value' => 'Meningkatkan koordinasi tubuh'],
            ['value' => 'Memperkuat otot dan jantung'],
            ['value' => 'Merangsang perkembangan otak']
        ];

        // Get a random kategori or create one if none exists
        $kategori = Kategori::inRandomOrder()->first() ?? Kategori::create(['nama_kategori' => 'Baby']);

        return [
            'nama_layanan' => $this->faker->unique()->randomElement($layananNames),
            'harga_layanan' => $this->faker->numberBetween(150000, 500000),
            'deskripsi' => $this->faker->paragraph(3),
            'image' => 'default-layanan.jpg',
            'kategori_id' => $kategori->id,
            'manfaat' => $this->faker->randomElements($manfaat, $this->faker->numberBetween(3, 6))
        ];
    }
}
