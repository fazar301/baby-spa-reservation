<?php

namespace Database\Seeders;

use App\Models\Sesi;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user if not exists
        // User::firstOrCreate(
        //     ['email' => 'admin@latumi.com'],
        //     [
        //         'name' => 'Admin',
        //         'password' => Hash::make('password'),
        //         'role' => 'admin'
        //     ]
        // );

        Sesi::create(['jam' => '08:00']);
        Sesi::create(['jam' => '09:00']);
        Sesi::create(['jam' => '10:00']);
        Sesi::create(['jam' => '11:00']);
        Sesi::create(['jam' => '12:00']);
        Sesi::create(['jam' => '13:00']);   
        Sesi::create(['jam' => '14:00']);
        Sesi::create(['jam' => '15:00']);
        Sesi::create(['jam' => '16:00']);
        Sesi::create(['jam' => '17:00']);
        

        // Run other seeders
        $this->call([
            DefaultUserSeeder::class,
            KategoriSeeder::class,
            KategoriArtikelSeeder::class,
            ArtikelSeeder::class,
            LayananSeeder::class,
            PaketLayananSeeder::class,
        ]);
    }
}
