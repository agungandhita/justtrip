<?php

namespace Database\Seeders;

use App\Models\GalleryLike;
use App\Models\Gallery;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class GalleryLikeSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        
        // Get all galleries and users
        $galleries = Gallery::all();
        $users = User::where('role', 'user')->get();
        
        if ($galleries->isEmpty() || $users->isEmpty()) {
            return;
        }
        
        // Create random likes for galleries
        foreach ($galleries as $gallery) {
            // Random number of likes per gallery (0-15)
            $likeCount = $faker->numberBetween(0, 15);
            
            // Get random users to like this gallery
            $randomUsers = $users->random(min($likeCount, $users->count()));
            
            foreach ($randomUsers as $user) {
                // Check if like already exists to avoid duplicates
                if (!GalleryLike::where('gallery_id', $gallery->id)
                                ->where('user_id', $user->id)
                                ->exists()) {
                    GalleryLike::create([
                        'gallery_id' => $gallery->id,
                        'user_id' => $user->id,
                        'created_at' => $faker->dateTimeBetween('-6 months', 'now'),
                        'updated_at' => now()
                    ]);
                }
            }
            
            // Update gallery likes count
            $actualLikes = GalleryLike::where('gallery_id', $gallery->id)->count();
            $gallery->update(['likes' => $actualLikes]);
        }
    }
}