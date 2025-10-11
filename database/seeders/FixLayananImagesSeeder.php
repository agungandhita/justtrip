<?php

namespace Database\Seeders;

use App\Models\Layanan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class FixLayananImagesSeeder extends Seeder
{
    public function run(): void
    {
        // Get all available image files
        $imageFiles = Storage::disk('public')->files('layanan/destinasi');
        
        if (empty($imageFiles)) {
            $this->command->info('No image files found in layanan/destinasi directory');
            return;
        }

        // Get all layanan records
        $layanans = Layanan::all();
        
        $this->command->info('Found ' . count($imageFiles) . ' image files');
        $this->command->info('Updating ' . $layanans->count() . ' layanan records');

        foreach ($layanans as $layanan) {
            // Randomly select 2-4 images for each layanan
            $numImages = rand(2, min(4, count($imageFiles)));
            $selectedImages = collect($imageFiles)->random($numImages)->toArray();
            
            // Update the layanan with correct image paths
            $layanan->update([
                'gambar_destinasi' => $selectedImages
            ]);
            
            $this->command->info('Updated ' . $layanan->nama_layanan . ' with ' . count($selectedImages) . ' images');
        }
        
        $this->command->info('Successfully updated all layanan image paths!');
    }
}