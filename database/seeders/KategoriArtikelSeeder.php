<?php

namespace Database\Seeders;

use App\Models\KategoriArtikel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriArtikelSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Truncate the table
        DB::table('kategori_artikels')->truncate();
        
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $kategoris = [
            [
                'nama' => 'Perkembangan Bayi',
                'slug' => 'perkembangan-bayi',
                'deskripsi' => 'Artikel tentang perkembangan dan pertumbuhan bayi',
                'is_active' => true
            ],
            [
                'nama' => 'Perawatan Bayi',
                'slug' => 'perawatan-bayi',
                'deskripsi' => 'Tips dan panduan perawatan bayi',
                'is_active' => true
            ],
            [
                'nama' => 'Terapi Air',
                'slug' => 'terapi-air',
                'deskripsi' => 'Informasi tentang terapi air untuk bayi',
                'is_active' => true
            ],
            [
                'nama' => 'Nutrisi Bayi',
                'slug' => 'nutrisi-bayi',
                'deskripsi' => 'Artikel tentang nutrisi dan makanan bayi',
                'is_active' => true
            ],
            [
                'nama' => 'Kesehatan Bayi',
                'slug' => 'kesehatan-bayi',
                'deskripsi' => 'Informasi tentang kesehatan dan penyakit bayi',
                'is_active' => true
            ]
        ];

        foreach ($kategoris as $kategori) {
            KategoriArtikel::create($kategori);
        }
    }
} 