<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@latumi.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Create customer user
        User::create([
            'name' => 'Customer',
            'email' => 'customer@latumi.com',
            'password' => Hash::make('customer123'),
            'email_verified_at' => now(),
            'role' => 'customer',
        ]);
    }
}
