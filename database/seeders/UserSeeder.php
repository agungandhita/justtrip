<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Indonesian locale

        // Create admin users
        $this->createAdminUsers($faker);
        
        // Create regular users with various scenarios
        $this->createRegularUsers($faker);
        
        // Create edge case users for testing
        $this->createEdgeCaseUsers($faker);
    }

    /**
     * Create admin users
     */
    private function createAdminUsers($faker)
    {
        // Main admin (already exists in AdminSeeder, but we'll create additional ones)
        User::create([
            'name' => 'Admin Travel',
            'email' => 'admin.travel@justtrip.com',
            'phone' => '081234567892',
            'address' => 'Jl. Sudirman No. 123, Jakarta Pusat',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Admin Content',
            'email' => 'content@justtrip.com',
            'phone' => '081234567893',
            'address' => 'Jl. Thamrin No. 456, Jakarta Pusat',
            'email_verified_at' => now(),
            'password' => Hash::make('content123'),
            'role' => 'admin',
        ]);
    }

    /**
     * Create regular users with various scenarios
     */
    private function createRegularUsers($faker)
    {
        // Active verified users
        for ($i = 0; $i < 25; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'email_verified_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'password' => Hash::make('password123'),
                'role' => 'user',
            ]);
        }

        // Unverified users (for testing email verification)
        for ($i = 0; $i < 5; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'email_verified_at' => null,
                'password' => Hash::make('password123'),
                'role' => 'user',
            ]);
        }

        // Users with minimal data (testing optional fields)
        for ($i = 0; $i < 5; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone' => null,
                'address' => null,
                'email_verified_at' => $faker->dateTimeBetween('-6 months', 'now'),
                'password' => Hash::make('password123'),
                'role' => 'user',
            ]);
        }

        // Users from different cities (for location-based testing)
        $cities = [
            'Jakarta', 'Bandung', 'Surabaya', 'Medan', 'Semarang',
            'Makassar', 'Palembang', 'Tangerang', 'Depok', 'Bekasi'
        ];

        foreach ($cities as $city) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->phoneNumber,
                'address' => $faker->streetAddress . ', ' . $city,
                'email_verified_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'password' => Hash::make('password123'),
                'role' => 'user',
            ]);
        }
    }

    /**
     * Create edge case users for testing
     */
    private function createEdgeCaseUsers($faker)
    {
        // User with very long name (testing field limits)
        User::create([
            'name' => 'Dr. Prof. ' . $faker->name . ' ' . $faker->lastName . ' ' . $faker->lastName,
            'email' => 'longname@justtrip.com',
            'phone' => '+62812345678901',
            'address' => $faker->address . ', RT 001/RW 002, Kelurahan ' . $faker->city . ', Kecamatan ' . $faker->city,
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        // User with special characters in name
        User::create([
            'name' => "Siti Nur'aini Al-Zahra",
            'email' => 'special.chars@justtrip.com',
            'phone' => '0812-3456-7890',
            'address' => 'Jl. K.H. Ahmad Dahlan No. 123/A',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        // User with international phone format
        User::create([
            'name' => 'International User',
            'email' => 'international@justtrip.com',
            'phone' => '+1-555-123-4567',
            'address' => '123 Main Street, New York, USA',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        // Recently registered user (for testing new user flows)
        User::create([
            'name' => 'New User',
            'email' => 'newuser@justtrip.com',
            'phone' => '081234567999',
            'address' => 'Jl. Baru No. 1, Jakarta',
            'email_verified_at' => now()->subMinutes(5),
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        // User with old registration (for testing long-term users)
        User::create([
            'name' => 'Veteran User',
            'email' => 'veteran@justtrip.com',
            'phone' => '081234567888',
            'address' => 'Jl. Veteran No. 100, Jakarta',
            'email_verified_at' => now()->subYears(2),
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);
    }
}