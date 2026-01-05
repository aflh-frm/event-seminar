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
        // 1. Akun Super Admin (Sesuai Client)
        User::create([
            'id' => 1, // Kita kunci ID-nya jadi 1
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('password'), // Password default
        ]);

        // 2. Akun EO / Panitia (Sesuai Client)
        // PENTING: ID 2 ini dibutuhkan oleh EventSeeder nanti
        User::create([
            'id' => 2,
            'name' => 'Panitia Event',
            'email' => 'eo@gmail.com',
            'role' => 'eo',
            'password' => Hash::make('password'),
        ]);

        // 3. Akun Peserta (Sesuai Client)
        User::create([
            'id' => 3,
            'name' => 'Peserta Seminar',
            'email' => 'user@gmail.com',
            'role' => 'user',
            'password' => Hash::make('password'),
        ]);
    }
}