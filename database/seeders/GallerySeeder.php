<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Carbon\Carbon;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        
        $destinations = ['Bali', 'Yogyakarta', 'Lombok', 'Bandung', 'Malang', 'Bromo', 'Raja Ampat', 'Labuan Bajo', 'Toba', 'Belitung'];
        $categories = ['trip', 'destination', 'activity', 'culture', 'nature', 'adventure'];
        $photographers = ['Andi Photo', 'Sari Lens', 'Budi Capture', 'Maya Shot', 'Rizki Frame'];
        
        // Create 40 gallery entries
        for ($i = 0; $i < 40; $i++) {
            $destination = $faker->randomElement($destinations);
            $title = 'Trip to ' . $destination . ' - ' . $faker->monthName . ' ' . $faker->year;
            
            Gallery::create([
                'title' => $title,
                'slug' => Str::slug($title) . '-' . $faker->unique()->numberBetween(1000, 9999),
                'description' => $faker->paragraph(2),
                'destination' => $destination,
                'trip_date' => $faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
                'main_image' => 'gallery/' . strtolower($destination) . '_main_' . ($i + 1) . '.jpg',
                'images' => [
                    'gallery/' . strtolower($destination) . '_1.jpg',
                    'gallery/' . strtolower($destination) . '_2.jpg',
                    'gallery/' . strtolower($destination) . '_3.jpg',
                    'gallery/' . strtolower($destination) . '_4.jpg',
                    'gallery/' . strtolower($destination) . '_5.jpg'
                ],
                'category' => $faker->randomElement($categories),
                'tags' => $faker->randomElements(['travel', 'indonesia', 'nature', 'culture', 'adventure', 'photography'], $faker->numberBetween(2, 4)),
                'participants_count' => $faker->numberBetween(2, 15),
                'trip_highlights' => $faker->sentence(10),
                'photographer' => $faker->randomElement($photographers),
                'alt_text' => 'Beautiful view of ' . $destination,
                'caption' => $faker->sentence(8),
                'status' => $faker->randomElement(['active', 'inactive']),
                'featured' => $faker->boolean(20),
                'sort_order' => $i,
                'location' => $destination . ', Indonesia',
                'date_taken' => $faker->dateTimeBetween('-2 years', 'now'),
                'is_public' => $faker->boolean(90),
                'views' => $faker->numberBetween(10, 1000),
                'likes' => $faker->numberBetween(0, 100)
            ]);
        }
    }
}