<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Layanan;
use Illuminate\Support\Str;

class UpdateLayananSlugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $layananList = Layanan::whereNull('slug')->orWhere('slug', '')->get();
        
        foreach ($layananList as $layanan) {
            $slug = Str::slug($layanan->nama_layanan);
            $originalSlug = $slug;
            $counter = 1;
            
            // Pastikan slug unik
            while (Layanan::where('slug', $slug)->where('layanan_id', '!=', $layanan->layanan_id)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }
            
            $layanan->update(['slug' => $slug]);
            $this->command->info("Updated slug for: {$layanan->nama_layanan} -> {$slug}");
        }
        
        $this->command->info('All layanan slugs have been updated successfully!');
    }
}
