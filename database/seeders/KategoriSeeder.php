<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Truncate the table
        DB::table('kategoris')->truncate();
        
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $kategoris = [
            ['nama_kategori' => 'Baby'],
            ['nama_kategori' => 'Kids'],
            ['nama_kategori' => 'Children']
        ];

        foreach ($kategoris as $kategori) {
            Kategori::create($kategori);
        }
    }
} 