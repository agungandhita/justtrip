<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin JustTrip',
            'email' => 'admin@justtrip.com',
            'phone' => '081234567890',
            'address' => 'Jakarta, Indonesia',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Create additional admin user for testing
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@justtrip.com',
            'phone' => '081234567891',
            'address' => 'Bandung, Indonesia',
            'email_verified_at' => now(),
            'password' => Hash::make('superadmin123'),
            'role' => 'admin',
        ]);
    }
}