<?php

namespace Database\Seeders;

use App\Models\Layanan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class LayananSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $jenisLayanan = [
            'paket_wisata',
            'tour_internasional',
            'private_trip',
            'honeymoon',
            'family_trip'
        ];

        $destinations = [
            'Bali', 'Yogyakarta', 'Lombok', 'Bandung', 'Malang', 'Bromo',
            'Raja Ampat', 'Labuan Bajo', 'Toba', 'Belitung', 'Jakarta',
            'Surabaya', 'Medan', 'Makassar', 'Manado'
        ];

        $fasilitas = [
            'Hotel berbintang', 'Transportasi AC', 'Makan 3x sehari',
            'Guide profesional', 'Tiket masuk wisata', 'Dokumentasi foto',
            'Asuransi perjalanan', 'Welcome drink', 'Souvenir khas daerah'
        ];

        // Create 50 layanan
        for ($i = 0; $i < 50; $i++) {
            $jenis = $faker->randomElement($jenisLayanan);
            $destination = $faker->randomElement($destinations);
            $durasi = $faker->numberBetween(2, 14);
            $harga = $faker->numberBetween(500000, 25000000);

            // Semua layanan sekarang harus memiliki maks_orang
            $maksOrang = $faker->numberBetween(2, 30);

            $namaLayanan = $this->generateLayananName($jenis, $destination, $durasi);
            $baseSlug = Str::slug($namaLayanan);
            $slug = $baseSlug;
            $counter = 1;
            
            // Ensure unique slug
            while (Layanan::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }
            
            Layanan::create([
                'nama_layanan' => $namaLayanan,
                'slug' => $slug,
                'jenis_layanan' => $jenis,
                'deskripsi' => $faker->paragraph(3),
                'harga_mulai' => $harga,
                'durasi_hari' => $durasi,
                'maks_orang' => $maksOrang,
                'lokasi_tujuan' => $destination,
                'fasilitas' => $faker->randomElements($fasilitas, $faker->numberBetween(4, 7)),
                'gambar_destinasi' => [
                    'layanan/' . strtolower($destination) . '_1.jpg',
                    'layanan/' . strtolower($destination) . '_2.jpg',
                    'layanan/' . strtolower($destination) . '_3.jpg'
                ],
                'status' => $faker->randomElement(['aktif', 'nonaktif']),
                'catatan' => $faker->optional(0.3)->sentence()
            ]);
        }
    }

    private function generateLayananName($jenis, $destination, $durasi)
    {
        $names = [
            'paket_wisata' => 'Paket Wisata ' . $destination . ' ' . $durasi . ' Hari',
            'tour_internasional' => 'Tour International ' . $destination,
            'private_trip' => 'Private Trip ' . $destination,
            'honeymoon' => 'Honeymoon Package ' . $destination,
            'family_trip' => 'Family Trip ' . $destination
        ];

        return $names[$jenis] ?? 'Paket Wisata ' . $destination;
    }
}
