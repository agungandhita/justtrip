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
        $authors = [
            ['name' => 'Andi Pratama', 'image' => 'authors/andi.jpg', 'bio' => 'Travel writer berpengalaman'],
            ['name' => 'Sari Dewi', 'image' => 'authors/sari.jpg', 'bio' => 'Food blogger dan travel enthusiast'],
            ['name' => 'Budi Santoso', 'image' => 'authors/budi.jpg', 'bio' => 'Fotografer travel']
        ];
        
        // Create 25 published articles
        for ($i = 0; $i < 25; $i++) {
            $category = $faker->randomElement($categories);
            $title = $this->generateTitle($faker, $category);
            $author = $faker->randomElement($authors);
            $publishedAt = $faker->dateTimeBetween('-6 months', 'now');
            
            News::create([
                'title' => $title,
                'slug' => Str::slug($title) . '-' . $faker->unique()->numberBetween(1000, 9999),
                'excerpt' => $faker->paragraph(2),
                'content' => $faker->paragraphs(5, true),
                'featured_image' => 'news/featured_' . ($i + 1) . '.jpg',
                'gallery_images' => [
                    'news/gallery_' . ($i + 1) . '_1.jpg',
                    'news/gallery_' . ($i + 1) . '_2.jpg'
                ],
                'category' => $category,
                'tags' => $this->generateTags($faker, $category),
                'author_name' => $author['name'],
                'author_image' => $author['image'],
                'author_bio' => $author['bio'],
                'read_time' => $faker->numberBetween(3, 15),
                'views' => $faker->numberBetween(50, 5000),
                'is_featured' => $faker->boolean(20),
                'is_published' => true,
                'status' => 'published',
                'published_at' => $publishedAt,
                'meta_title' => $title . ' | JustTrip Blog',
                'meta_description' => $faker->sentence(15)
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
                'excerpt' => $faker->paragraph(1),
                'content' => $faker->paragraphs(3, true),
                'featured_image' => 'news/draft_' . ($i + 1) . '.jpg',
                'gallery_images' => null,
                'category' => $category,
                'tags' => $this->generateTags($faker, $category),
                'author_name' => $author['name'],
                'author_image' => $author['image'],
                'author_bio' => $author['bio'],
                'read_time' => $faker->numberBetween(2, 8),
                'views' => 0,
                'is_featured' => false,
                'is_published' => false,
                'status' => 'draft',
                'published_at' => null,
                'meta_title' => null,
                'meta_description' => null
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
    
    private function generateTags($faker, $category)
    {
        $tagsByCategory = [
            'destinasi' => ['wisata', 'destinasi', 'traveling', 'indonesia'],
            'tips' => ['tips', 'panduan', 'travel', 'hemat'],
            'guide' => ['guide', 'panduan', 'itinerary', 'transportasi'],
            'kuliner' => ['kuliner', 'makanan', 'food', 'restoran'],
            'budaya' => ['budaya', 'tradisi', 'sejarah', 'lokal'],
            'adventure' => ['adventure', 'petualangan', 'hiking', 'diving']
        ];
        
        $baseTags = $tagsByCategory[$category] ?? ['travel', 'indonesia'];
        return $faker->randomElements($baseTags, $faker->numberBetween(2, 4));
    }
}