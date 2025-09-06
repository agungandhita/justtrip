<?php

namespace Database\Seeders;

use App\Models\SpecialOffer;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class SpecialOfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Create active special offers
        $this->createActiveOffers($faker);
        
        // Create expired offers (for testing historical data)
        $this->createExpiredOffers($faker);
        
        // Create future offers (for testing upcoming promotions)
        $this->createFutureOffers($faker);
        
        // Create edge case offers
        $this->createEdgeCaseOffers($faker);
    }

    /**
     * Create active special offers
     */
    private function createActiveOffers($faker)
    {
        $destinations = [
            'Bali', 'Yogyakarta', 'Lombok', 'Bandung', 'Malang',
            'Bromo', 'Raja Ampat', 'Labuan Bajo', 'Toba', 'Belitung'
        ];

        $offerTypes = [
            'flash_sale', 'early_bird', 'group_discount', 'last_minute',
            'seasonal', 'weekend_special', 'honeymoon_package'
        ];

        $badgeColors = ['red', 'orange', 'green', 'blue', 'purple', 'pink'];

        foreach ($destinations as $destination) {
            $originalPrice = $faker->numberBetween(1500000, 15000000);
            $discountPercentage = $faker->numberBetween(10, 70);
            $discountedPrice = $originalPrice * (100 - $discountPercentage) / 100;

            SpecialOffer::create([
                'title' => 'Paket Wisata ' . $destination . ' ' . $faker->randomElement(['Ekslusif', 'Premium', 'Hemat', 'Spesial']),
                'description' => $faker->paragraph(3) . ' Nikmati keindahan ' . $destination . ' dengan fasilitas terbaik dan harga terjangkau.',
                'offer_type' => $faker->randomElement($offerTypes),
                'original_price' => $originalPrice,
                'discounted_price' => $discountedPrice,
                'discount_percentage' => $discountPercentage,
                'destination' => $destination,
                'main_image' => 'images/destinations/' . strtolower($destination) . '_main.jpg',
                'gallery_images' => [
                    'images/destinations/' . strtolower($destination) . '_1.jpg',
                    'images/destinations/' . strtolower($destination) . '_2.jpg',
                    'images/destinations/' . strtolower($destination) . '_3.jpg',
                    'images/destinations/' . strtolower($destination) . '_4.jpg'
                ],
                'valid_from' => Carbon::now()->subDays($faker->numberBetween(1, 30)),
                'valid_until' => Carbon::now()->addDays($faker->numberBetween(30, 90)),
                'terms_conditions' => $this->generateTermsConditions($faker),
                'max_bookings' => $faker->numberBetween(20, 100),
                'current_bookings' => $faker->numberBetween(0, 15),
                'is_featured' => $faker->boolean(30), // 30% chance to be featured
                'is_active' => true,
                'badge_text' => $this->getBadgeText($faker->randomElement($offerTypes)),
                'badge_color' => $faker->randomElement($badgeColors)
            ]);
        }

        // Create some high-demand offers (almost sold out)
        for ($i = 0; $i < 3; $i++) {
            $maxBookings = $faker->numberBetween(20, 50);
            $currentBookings = $maxBookings - $faker->numberBetween(1, 5);
            $originalPrice = $faker->numberBetween(2000000, 8000000);
            $discountPercentage = $faker->numberBetween(40, 60);
            $discountedPrice = $originalPrice * (100 - $discountPercentage) / 100;

            SpecialOffer::create([
                'title' => 'Flash Sale ' . $faker->randomElement($destinations),
                'description' => 'Penawaran terbatas! Hanya tersisa beberapa slot lagi. ' . $faker->paragraph(2),
                'offer_type' => 'flash_sale',
                'original_price' => $originalPrice,
                'discounted_price' => $discountedPrice,
                'discount_percentage' => $discountPercentage,
                'destination' => $faker->randomElement($destinations),
                'main_image' => 'images/flash_sale_' . ($i + 1) . '.jpg',
                'gallery_images' => [
                    'images/flash_sale_' . ($i + 1) . '_1.jpg',
                    'images/flash_sale_' . ($i + 1) . '_2.jpg'
                ],
                'valid_from' => Carbon::now()->subDays(5),
                'valid_until' => Carbon::now()->addDays($faker->numberBetween(3, 7)),
                'terms_conditions' => $this->generateTermsConditions($faker),
                'max_bookings' => $maxBookings,
                'current_bookings' => $currentBookings,
                'is_featured' => true,
                'is_active' => true,
                'badge_text' => 'HAMPIR HABIS',
                'badge_color' => 'red'
            ]);
        }
    }

    /**
     * Create expired offers for testing historical data
     */
    private function createExpiredOffers($faker)
    {
        $destinations = ['Jakarta', 'Surabaya', 'Medan', 'Makassar'];

        for ($i = 0; $i < 5; $i++) {
            $originalPrice = $faker->numberBetween(1000000, 5000000);
            $discountPercentage = $faker->numberBetween(15, 45);
            $discountedPrice = $originalPrice * (100 - $discountPercentage) / 100;

            SpecialOffer::create([
                'title' => 'Promo Berakhir - ' . $faker->randomElement($destinations),
                'description' => $faker->paragraph(2),
                'offer_type' => $faker->randomElement(['early_bird', 'seasonal']),
                'original_price' => $originalPrice,
                'discounted_price' => $discountedPrice,
                'discount_percentage' => $discountPercentage,
                'destination' => $faker->randomElement($destinations),
                'main_image' => 'images/expired_offer_' . ($i + 1) . '.jpg',
                'gallery_images' => ['images/expired_offer_' . ($i + 1) . '_1.jpg'],
                'valid_from' => Carbon::now()->subDays($faker->numberBetween(60, 120)),
                'valid_until' => Carbon::now()->subDays($faker->numberBetween(1, 30)),
                'terms_conditions' => $this->generateTermsConditions($faker),
                'max_bookings' => $faker->numberBetween(30, 80),
                'current_bookings' => $faker->numberBetween(20, 80),
                'is_featured' => false,
                'is_active' => false,
                'badge_text' => 'BERAKHIR',
                'badge_color' => 'gray'
            ]);
        }
    }

    /**
     * Create future offers for testing upcoming promotions
     */
    private function createFutureOffers($faker)
    {
        $destinations = ['Nusa Penida', 'Gili Trawangan', 'Karimunjawa', 'Derawan'];

        for ($i = 0; $i < 4; $i++) {
            $originalPrice = $faker->numberBetween(3000000, 12000000);
            $discountPercentage = $faker->numberBetween(20, 50);
            $discountedPrice = $originalPrice * (100 - $discountPercentage) / 100;

            SpecialOffer::create([
                'title' => 'Coming Soon - ' . $faker->randomElement($destinations),
                'description' => 'Segera hadir! ' . $faker->paragraph(2),
                'offer_type' => 'early_bird',
                'original_price' => $originalPrice,
                'discounted_price' => $discountedPrice,
                'discount_percentage' => $discountPercentage,
                'destination' => $faker->randomElement($destinations),
                'main_image' => 'images/coming_soon_' . ($i + 1) . '.jpg',
                'gallery_images' => [
                    'images/coming_soon_' . ($i + 1) . '_1.jpg',
                    'images/coming_soon_' . ($i + 1) . '_2.jpg'
                ],
                'valid_from' => Carbon::now()->addDays($faker->numberBetween(7, 30)),
                'valid_until' => Carbon::now()->addDays($faker->numberBetween(60, 120)),
                'terms_conditions' => $this->generateTermsConditions($faker),
                'max_bookings' => $faker->numberBetween(25, 75),
                'current_bookings' => 0,
                'is_featured' => $faker->boolean(50),
                'is_active' => true,
                'badge_text' => 'SEGERA HADIR',
                'badge_color' => 'blue'
            ]);
        }
    }

    /**
     * Create edge case offers for testing
     */
    private function createEdgeCaseOffers($faker)
    {
        // Offer with very high discount
        SpecialOffer::create([
            'title' => 'Super Mega Sale Bali - Diskon Gila!',
            'description' => 'Diskon fantastis untuk paket wisata Bali. Kesempatan langka!',
            'offer_type' => 'flash_sale',
            'original_price' => 10000000,
            'discounted_price' => 2000000,
            'discount_percentage' => 80,
            'destination' => 'Bali',
            'main_image' => 'images/mega_sale_bali.jpg',
            'gallery_images' => ['images/mega_sale_bali_1.jpg'],
            'valid_from' => Carbon::now(),
            'valid_until' => Carbon::now()->addDays(3),
            'terms_conditions' => $this->generateTermsConditions($faker),
            'max_bookings' => 10,
            'current_bookings' => 8,
            'is_featured' => true,
            'is_active' => true,
            'badge_text' => 'DISKON 80%',
            'badge_color' => 'red'
        ]);

        // Offer with no discount (regular price)
        SpecialOffer::create([
            'title' => 'Paket Premium Lombok - Tanpa Diskon',
            'description' => 'Paket premium dengan fasilitas terbaik, harga tetap.',
            'offer_type' => 'premium',
            'original_price' => 5000000,
            'discounted_price' => 5000000,
            'discount_percentage' => 0,
            'destination' => 'Lombok',
            'main_image' => 'images/premium_lombok.jpg',
            'gallery_images' => ['images/premium_lombok_1.jpg'],
            'valid_from' => Carbon::now()->subDays(10),
            'valid_until' => Carbon::now()->addDays(60),
            'terms_conditions' => $this->generateTermsConditions($faker),
            'max_bookings' => 50,
            'current_bookings' => 5,
            'is_featured' => false,
            'is_active' => true,
            'badge_text' => 'PREMIUM',
            'badge_color' => 'gold'
        ]);

        // Offer ending today
        SpecialOffer::create([
            'title' => 'Last Day Sale - Yogyakarta',
            'description' => 'Hari terakhir! Jangan sampai terlewat.',
            'offer_type' => 'last_minute',
            'original_price' => 3000000,
            'discounted_price' => 2100000,
            'discount_percentage' => 30,
            'destination' => 'Yogyakarta',
            'main_image' => 'images/last_day_yogya.jpg',
            'gallery_images' => ['images/last_day_yogya_1.jpg'],
            'valid_from' => Carbon::now()->subDays(7),
            'valid_until' => Carbon::now()->endOfDay(),
            'terms_conditions' => $this->generateTermsConditions($faker),
            'max_bookings' => 30,
            'current_bookings' => 25,
            'is_featured' => true,
            'is_active' => true,
            'badge_text' => 'HARI TERAKHIR',
            'badge_color' => 'red'
        ]);
    }

    /**
     * Generate terms and conditions
     */
    private function generateTermsConditions($faker)
    {
        $terms = [
            'Berlaku untuk pemesanan hingga ' . Carbon::now()->addDays(30)->format('d F Y'),
            'Minimal pemesanan 2 orang',
            'Tidak berlaku untuk hari libur nasional',
            'Pembayaran dapat dilakukan dengan transfer bank atau kartu kredit',
            'Pembatalan gratis hingga 7 hari sebelum keberangkatan',
            'Harga sudah termasuk akomodasi dan transportasi',
            'Tidak termasuk tiket pesawat',
            'Berlaku untuk WNI dan WNA',
            'Syarat dan ketentuan dapat berubah sewaktu-waktu'
        ];

        return implode("\n", $faker->randomElements($terms, $faker->numberBetween(4, 7)));
    }

    /**
     * Get badge text based on offer type
     */
    private function getBadgeText($offerType)
    {
        $badges = [
            'flash_sale' => 'FLASH SALE',
            'early_bird' => 'EARLY BIRD',
            'group_discount' => 'GROUP DISCOUNT',
            'last_minute' => 'LAST MINUTE',
            'seasonal' => 'SEASONAL',
            'weekend_special' => 'WEEKEND SPECIAL',
            'honeymoon_package' => 'HONEYMOON'
        ];

        return $badges[$offerType] ?? 'SPECIAL OFFER';
    }
}