<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Create Admin
        User::create([
            'name' => 'Admin BSI',
            'email' => 'admin@bsi.co.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Create User (Nasabah)
        User::create([
            'name' => 'Nasabah 1',
            'email' => 'nasabah@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'user',
            'nik_ktp' => '1234567890123456'
        ]);
    }
}
