<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call all seeders in proper order
        $this->call([
            AdminSeeder::class,
            UserSeeder::class,
            LayananSeeder::class,
            SpecialOfferSeeder::class,
            NewsSeeder::class,
            GallerySeeder::class,
            GalleryLikeSeeder::class, // Must be last to ensure galleries and users exist
        ]);

        // Create additional test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role' => 'user',
        ]);
    }
}
