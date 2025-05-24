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
        // User::factory(10)->create();

        // Admin
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'phone' => '08123456789',
            'address' => 'Makassar',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Budi
        User::factory()->create([
            'name' => 'budi',
            'email' => 'budi@gmail.com',
            'phone' => '08123456789',
            'address' => 'Sudiang',
            'password' => Hash::make('budi12345'),
            'role' => 'user',
        ]);
    }
}
