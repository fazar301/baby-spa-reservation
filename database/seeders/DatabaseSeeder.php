<?php

namespace Database\Seeders;

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

        // Run other seeders
        $this->call([
            DefaultUserSeeder::class,
            KategoriSeeder::class,
            LayananSeeder::class,
            PaketLayananSeeder::class,
        ]);
    }
}
