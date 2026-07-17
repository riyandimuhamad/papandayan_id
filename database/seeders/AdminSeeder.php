<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Ubah akun pertama menjadi Developer (Super Admin)
        $dev = \App\Models\User::first();
        if ($dev) {
            $dev->update([
                'name' => 'Riyandi (Developer)',
                'email' => 'developer@papandayan-id.com',
                'role' => 'super_admin'
            ]);
        }

        // 2. Buat akun Admin untuk Klien
        \App\Models\User::updateOrCreate(
            ['email' => 'admin@papandayan-id.com'],
            [
                'name' => 'Admin Papandayan',
                'password' => bcrypt('password123'),
                'role' => 'admin',
                'is_active' => true,
            ]
        );
    }
}
