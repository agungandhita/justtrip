<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\SpecialOffer;
use App\Models\Layanan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookingService
{
    /**
     * Create a promo booking for special offer
     */
    public function createPromoBooking(array $data, SpecialOffer $specialOffer): Booking
    {
        // Calculate pricing
        $pricing = $this->calculatePromoPricing($specialOffer, $data['jumlah_peserta']);

        // Prepare booking data
        $bookingData = [
            'user_id' => auth()->id(),
            'layanan_id' => $specialOffer->layanan_id ?? $data['layanan_id'] ?? null,
            'special_offer_id' => $specialOffer->id,
            'booking_number' => Booking::generateBookingNumber(),
            'booking_date' => now(),
            'original_amount' => $pricing['original_total'],
            'discount_amount' => $pricing['discount_amount'],
            'total_amount' => $pricing['total_amount'],
            'status' => 'pending',
            'customer_info' => [
                'name' => $data['nama_lengkap'],
                'email' => $data['email'],
                'phone' => $data['nomor_telepon'],
                'address' => $data['alamat'] ?? ''
            ],
            'jumlah_peserta' => $data['jumlah_peserta'],
            'tanggal_keberangkatan' => $data['tanggal_keberangkatan'],
            'catatan_khusus' => $data['catatan'] ?? null
        ];

        DB::beginTransaction();
        try {
            // Create booking
            $booking = Booking::create($bookingData);

            // Update special offer current bookings
            $specialOffer->increment('current_bookings');

            DB::commit();
            
            Log::info('Promo booking created successfully', [
                'booking_id' => $booking->booking_id,
                'booking_number' => $booking->booking_number
            ]);

            return $booking;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Failed to create promo booking', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    /**
     * Create a regular package booking
     */
    public function createRegularBooking(array $data, Layanan $layanan, ?SpecialOffer $specialOffer = null): Booking
    {
        // Parse selected options from request data
        $selectedOptions = $data['selected_options'] ?? [];
        
        // Calculate pricing
        $pricing = $this->calculateRegularPricing($layanan, $data['jumlah_peserta'], $specialOffer, $selectedOptions);

        $user = auth()->user();

        // Prepare booking data
        $bookingData = [
            'user_id' => $user->id,
            'layanan_id' => $layanan->layanan_id,
            'special_offer_id' => $specialOffer?->id,
            'booking_number' => Booking::generateBookingNumber(),
            'booking_date' => now(),
            'original_amount' => $pricing['original_amount'],
            'discount_amount' => $pricing['discount_amount'],
            'options_amount' => $pricing['options_amount'],
            'total_amount' => $pricing['total_amount'],
            'status' => 'pending',
            'customer_info' => [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'address' => $user->address
            ],
            'selected_options' => $pricing['selected_options_detail'],
            'jumlah_peserta' => $data['jumlah_peserta'],
            'tanggal_keberangkatan' => $data['tanggal_keberangkatan'],
            'catatan_khusus' => $data['catatan_khusus'] ?? null
        ];

        DB::beginTransaction();
        try {
            // Create booking
            $booking = Booking::create($bookingData);

            DB::commit();

            Log::info('Regular booking created successfully', [
                'booking_id' => $booking->booking_id,
                'booking_number' => $booking->booking_number
            ]);

            return $booking;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Failed to create regular booking', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    /**
     * Calculate pricing for promo booking
     */
    public function calculatePromoPricing(SpecialOffer $specialOffer, int $participants): array
    {
        $pricePerPerson = $specialOffer->discounted_price;
        $subtotal = $pricePerPerson * $participants;
        
        // Calculate discount (difference from original to discounted)
        $originalPriceTotal = $specialOffer->original_price * $participants;
        $discountAmount = $originalPriceTotal - $subtotal;
        
        // Total without PPN
        $totalAmount = $subtotal;

        return [
            'price_per_person' => $pricePerPerson,
            'original_total' => $originalPriceTotal,
            'subtotal' => $subtotal,
            'discount_amount' => $discountAmount,
            'total_amount' => $totalAmount,
        ];
    }

    /**
     * Calculate pricing for regular booking
     */
    public function calculateRegularPricing(Layanan $layanan, int $participants, ?SpecialOffer $specialOffer = null, array $selectedOptionTypes = []): array
    {
        $originalAmount = $layanan->harga_mulai * $participants;
        $discountAmount = 0;

        if ($specialOffer) {
            $discountAmount = ($originalAmount * $specialOffer->discount_percentage) / 100;
        }

        // Calculate optional pricing additions
        $optionsAmount = 0;
        $selectedOptionsDetail = [];
        $availablePricingOptions = $layanan->pricing_options ?? [];

        if (!empty($selectedOptionTypes) && !empty($availablePricingOptions)) {
            foreach ($availablePricingOptions as $option) {
                if (in_array($option['type'], $selectedOptionTypes)) {
                    $optionPrice = (float) $option['price'];
                    $optionsAmount += $optionPrice * $participants;
                    $selectedOptionsDetail[] = [
                        'type' => $option['type'],
                        'price_per_person' => $optionPrice,
                        'total_price' => $optionPrice * $participants,
                    ];
                }
            }
        }

        $amountAfterDiscount = $originalAmount - $discountAmount;
        $totalAmount = $amountAfterDiscount + $optionsAmount; // Base + options, no PPN

        return [
            'original_amount' => $originalAmount,
            'discount_amount' => $discountAmount,
            'options_amount' => $optionsAmount,
            'total_amount' => $totalAmount,
            'selected_options_detail' => $selectedOptionsDetail,
        ];
    }

    /**
     * Validate if special offer is still available
     */
    public function validateSpecialOffer(SpecialOffer $specialOffer): array
    {
        $errors = [];

        // Check if promo is active
        if (!$specialOffer->is_active || $specialOffer->valid_until < now()) {
            $errors[] = 'Maaf, promo ini sudah tidak berlaku.';
        }

        // Check if max bookings reached
        if ($specialOffer->max_bookings && $specialOffer->current_bookings >= $specialOffer->max_bookings) {
            $errors[] = 'Maaf, kuota untuk promo ini sudah habis.';
        }

        return $errors;
    }
}
