<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'sandi' => Hash::make('password'),
            'peran' => 'admin',
            'no_telepon' => '081234567890',
        ]);

        // Petani
        User::create([
            'name' => 'Petani User',
            'email' => 'petani@gmail.com',
            'sandi' => Hash::make('password'),
            'peran' => 'petani',
            'no_telepon' => '081234567891',
        ]);

        // Mitra
        User::create([
            'name' => 'Mitra User',
            'email' => 'mitra@gmail.com',
            'sandi' => Hash::make('password'),
            'peran' => 'mitra',
            'no_telepon' => '081234567892',
        ]);
    }
}
