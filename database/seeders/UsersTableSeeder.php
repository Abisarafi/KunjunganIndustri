<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Adjust the namespace based on your actual model location
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed an admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'noHP' => '987973321',
            'email_verified_at' => now(),
            'password' => Hash::make('adminpassword123'),
        ]);

        // You can add more users as needed
    }
}