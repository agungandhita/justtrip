<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Carbon\Carbon;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        
        $categories = ['destinasi', 'tips', 'guide', 'kuliner', 'budaya', 'adventure'];
        $authors = ['Andi Pratama', 'Sari Dewi', 'Budi Santoso'];
        
        // Create 25 published articles
        for ($i = 0; $i < 25; $i++) {
            $category = $faker->randomElement($categories);
            $title = $this->generateTitle($faker, $category);
            $author = $faker->randomElement($authors);
            $publishedAt = $faker->dateTimeBetween('-6 months', 'now');
            
            News::create([
                'title' => $title,
                'slug' => Str::slug($title) . '-' . $faker->unique()->numberBetween(1000, 9999),
                'content' => $faker->paragraphs(5, true),
                'featured_image' => 'news/featured_' . ($i + 1) . '.jpg',
                'category' => $category,
                'author_name' => $author,
                'views' => $faker->numberBetween(50, 5000),
                'is_featured' => $faker->boolean(20),
                'status' => 'published',
                'published_at' => $publishedAt,
            ]);
        }
        
        // Create 5 draft articles
        for ($i = 0; $i < 5; $i++) {
            $category = $faker->randomElement($categories);
            $title = $this->generateTitle($faker, $category);
            $author = $faker->randomElement($authors);
            
            News::create([
                'title' => $title,
                'slug' => Str::slug($title) . '-draft-' . $faker->unique()->numberBetween(1000, 9999),
                'content' => $faker->paragraphs(3, true),
                'featured_image' => 'news/draft_' . ($i + 1) . '.jpg',
                'category' => $category,
                'author_name' => $author,
                'views' => 0,
                'is_featured' => false,
                'status' => 'draft',
                'published_at' => null,
            ]);
        }
    }
    
    private function generateTitle($faker, $category)
    {
        $destinations = ['Bali', 'Yogyakarta', 'Lombok', 'Bandung', 'Malang'];
        $destination = $faker->randomElement($destinations);
        
        $titles = [
            'destinasi' => 'Keindahan Tersembunyi ' . $destination,
            'tips' => 'Tips Hemat Traveling ke ' . $destination,
            'guide' => 'Panduan Lengkap Wisata ' . $destination,
            'kuliner' => 'Kuliner Khas ' . $destination . ' yang Wajib Dicoba',
            'budaya' => 'Budaya dan Tradisi ' . $destination,
            'adventure' => 'Petualangan Seru di ' . $destination
        ];
        
        return $titles[$category] ?? 'Wisata ' . $destination;
    }
}