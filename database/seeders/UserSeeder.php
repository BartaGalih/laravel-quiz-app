<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name'       => 'Admin',
            'email'      => 'admin@example.com',
            'password'   => Hash::make('password'),
            'is_admin'   => true,
            'created_at' => now()->subMonths(6),
            'updated_at' => now()->subMonths(6),
        ]);

        User::create([
            'name'       => 'User',
            'email'      => 'user@example.com',
            'password'   => Hash::make('password'),
            'is_admin'   => false,
            'created_at' => now()->subMonths(6),
            'updated_at' => now()->subMonths(6),
        ]);

        // Regular students
        $students = [
            ['name' => 'Budi Santoso',     'email' => 'budi@example.com'],
            ['name' => 'Siti Rahayu',      'email' => 'siti@example.com'],
            ['name' => 'Ahmad Fauzi',      'email' => 'ahmad@example.com'],
            ['name' => 'Dewi Lestari',     'email' => 'dewi@example.com'],
            ['name' => 'Rizky Pratama',    'email' => 'rizky@example.com'],
            ['name' => 'Nur Hidayah',      'email' => 'nur@example.com'],
            ['name' => 'Andi Wijaya',      'email' => 'andi@example.com'],
            ['name' => 'Fitriani Putri',   'email' => 'fitri@example.com'],
            ['name' => 'Dimas Ardiansyah', 'email' => 'dimas@example.com'],
            ['name' => 'Mega Sari',        'email' => 'mega@example.com'],
        ];

        foreach ($students as $i => $student) {
            User::create([
                'name'       => $student['name'],
                'email'      => $student['email'],
                'password'   => Hash::make('password'),
                'is_admin'   => false,
                'created_at' => now()->subDays(rand(10, 90)),
                'updated_at' => now()->subDays(rand(1, 9)),
            ]);
        }
    }
}
