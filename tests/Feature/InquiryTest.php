<?php

namespace Tests\Feature;

use App\Models\Layanan;
use App\Models\SpecialOffer;
use Tests\TestCase;

class InquiryTest extends TestCase
{
    public function test_packages_show_page_renders_inquiry_modal(): void
    {
        $layanan = Layanan::first();
        if ($layanan) {
            $response = $this->get(route('packages.show', $layanan->slug));
            $response->assertStatus(200);
            $response->assertSee('inquiry-modal');
            $response->assertSee('Kirim ke WhatsApp Admin');
        } else {
            $this->markTestSkipped('No Layanan found in DB');
        }
    }

    public function test_packages_show_renders_all_admin_fields(): void
    {
        $layanan = Layanan::first();
        if (!$layanan) {
            $this->markTestSkipped('No Layanan found in DB');
        }

        $layanan->update([
            'status'           => 'aktif',
            'destinations'     => ['Kawah Ijen Blue Fire', 'Savana Bekol'],
            'itinerary_note'   => 'Catatan khusus jadwal keberangkatan menyesuaikan pasang surut',
            'catatan'          => 'Wajib membawa jaket tebal dan masker gas',
            'terms_conditions' => [
                'registration_payment' => ['DP 50% saat booking'],
                'cancelation'          => ['H-3 tidak bisa refund'],
                'not_responsible_for'  => ['Kehilangan barang bawaan pribadi peserta'],
            ],
        ]);

        $response = $this->get(route('packages.show', $layanan->fresh()->slug));
        $response->assertStatus(200);
        $response->assertSee('Kawah Ijen Blue Fire');
        $response->assertSee('Savana Bekol');
        $response->assertSee('Catatan khusus jadwal keberangkatan menyesuaikan pasang surut');
        $response->assertSee('Wajib membawa jaket tebal dan masker gas');
        $response->assertSee('Kehilangan barang bawaan pribadi peserta');
        $response->assertSee('Batasan Tanggung Jawab');
    }

    public function test_special_offer_show_page_renders_inquiry_modal(): void
    {
        $offer = SpecialOffer::first();
        if ($offer) {
            $offer->update([
                'is_active'   => true,
                'valid_until' => now()->addMonths(3),
            ]);

            $response = $this->get(route('special-offers.show', $offer));
            $response->assertStatus(200);
            $response->assertSee('inquiry-modal');
            $response->assertSee('Pesan Promo via WhatsApp');
        } else {
            $this->markTestSkipped('No SpecialOffer found in DB');
        }
    }

    public function test_inquiry_validation_requires_mandatory_fields(): void
    {
        $response = $this->postJson(route('inquiry.send'), []);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors([
            'nama_lengkap',
            'nomor_whatsapp',
            'jumlah_peserta',
            'tanggal_keberangkatan',
        ]);
    }

    public function test_inquiry_can_be_submitted_and_returns_whatsapp_url(): void
    {
        $layanan = Layanan::first();
        $tomorrow = now()->addDays(3)->format('Y-m-d');

        $response = $this->postJson(route('inquiry.send'), [
            'layanan_id'            => $layanan?->layanan_id,
            'nama_lengkap'          => 'Budi Santoso',
            'nomor_whatsapp'        => '081234567890',
            'email'                 => 'budi@example.com',
            'alamat'                => 'Jakarta Selatan',
            'jumlah_peserta'        => 2,
            'tanggal_keberangkatan' => $tomorrow,
            'catatan_tambahan'      => 'Mohon kamar yang non-smoking',
            'request_tambahan'      => 'Dokumentasi Drone & Kamera',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'message',
            'whatsapp_url',
            'package_name',
            'total',
        ]);
        $response->assertJsonFragment([
            'success' => true,
        ]);

        $whatsappUrl = $response->json('whatsapp_url');
        $this->assertStringContainsString('api.whatsapp.com', $whatsappUrl);
        $this->assertStringContainsString('Budi%20Santoso', $whatsappUrl);
        $this->assertStringContainsString('Dokumentasi%20Drone', $whatsappUrl);
    }
}
