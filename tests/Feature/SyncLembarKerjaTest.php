<?php

namespace Tests\Feature;

use App\Models\Layanan;
use Tests\TestCase;

class SyncLembarKerjaTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config([
            'app.url' => 'https://justtriptour.com',
            'database.default' => 'sqlite',
            'database.connections.sqlite.database' => ':memory:',
            'cache.default' => 'array',
        ]);

        $this->artisan('migrate');
    }

    public function test_sitemap_xml_returns_200_xml_and_correct_routes(): void
    {
        Layanan::create([
            'nama_layanan' => 'Bromo Midnight Tour',
            'slug' => 'bromo-midnight-tour',
            'jenis_layanan' => 'Open Trip',
            'deskripsi' => 'Paket wisata Bromo midnight seru.',
            'durasi_hari' => 1,
            'maks_orang' => 10,
            'lokasi_tujuan' => 'Bromo',
            'harga_mulai' => 350000,
            'status' => 'aktif',
        ]);

        Layanan::create([
            'nama_layanan' => 'Paket Rahasia',
            'slug' => 'paket-rahasia-hidden',
            'jenis_layanan' => 'Private',
            'deskripsi' => 'Paket tidak aktif.',
            'durasi_hari' => 1,
            'maks_orang' => 5,
            'lokasi_tujuan' => 'Yogyakarta',
            'harga_mulai' => 1000000,
            'status' => 'nonaktif',
        ]);

        $response = $this->get('/sitemap.xml');

        $response->assertStatus(200);
        $this->assertStringContainsString('application/xml', (string) $response->headers->get('Content-Type'));

        $content = $response->getContent();
        $this->assertStringContainsString('<loc>https://justtriptour.com/</loc>', $content);
        $this->assertStringContainsString('<loc>https://justtriptour.com/packages</loc>', $content);
        $this->assertStringContainsString('<loc>https://justtriptour.com/packages/bromo-midnight-tour</loc>', $content);

        // Excluded routes
        $this->assertStringNotContainsString('https://justtriptour.com/home', $content);
        $this->assertStringNotContainsString('https://justtriptour.com/destinasi', $content);
        $this->assertStringNotContainsString('https://justtriptour.com/corporate-gathering', $content);
        $this->assertStringNotContainsString('paket-rahasia-hidden', $content);
    }

    public function test_destinasi_redirects_301_to_packages(): void
    {
        $response = $this->get('/destinasi');

        $response->assertStatus(301);
        $response->assertRedirect(route('packages.index'));
    }

    public function test_home_contains_gtm_pixel_canonical_and_single_h1(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $content = $response->getContent();

        // GTM ID exactly 2 times (head script & noscript iframe)
        $gtmCount = substr_count($content, 'GTM-T495H3ZH');
        $this->assertEquals(2, $gtmCount, 'GTM-T495H3ZH must appear exactly 2 times');

        // Meta Pixel Base ID
        $this->assertStringContainsString('1399604144849394', $content);

        // No vite dev server localhost
        $this->assertStringNotContainsString('5173', $content);

        // No hardcoded old title
        $this->assertStringNotContainsString('Justtrip - #TripGagalMoveOn', $content);

        // Canonical exists
        $this->assertStringContainsString('<link rel="canonical" href="https://justtriptour.com/">', $content);

        // Exactly one <h1> heading
        preg_match_all('/<h1[^>]*>.*?<\/h1>/si', $content, $h1Matches);
        $this->assertCount(1, $h1Matches[0], 'Homepage must contain exactly one <h1> element');
    }

    public function test_corporate_gathering_page_structure_and_tracking(): void
    {
        $response = $this->get('/corporate-gathering');

        $response->assertStatus(200);
        $content = $response->getContent();

        // No navbar
        $this->assertStringNotContainsString('<nav', $content);

        // WhatsApp link present
        $this->assertStringContainsString('wa.me/6282266478147', $content);

        // Lead & ViewContent events present
        $this->assertStringContainsString("fbq('track', 'Lead'", $content);
        $this->assertStringContainsString("fbq('track', 'ViewContent'", $content);

        // No Tailwind CDN
        $this->assertStringNotContainsString('cdn.tailwindcss.com', $content);

        // Noindex robots tag
        $this->assertStringContainsString('content="noindex,follow"', $content);
    }

    public function test_legal_pages_render_and_include_tracking(): void
    {
        $privacy = $this->get('/privacy-policy');
        $privacy->assertStatus(200);
        $this->assertStringContainsString('GTM-T495H3ZH', $privacy->getContent());
        $this->assertStringContainsString('1399604144849394', $privacy->getContent());

        $terms = $this->get('/terms-of-service');
        $terms->assertStatus(200);
        $this->assertStringContainsString('GTM-T495H3ZH', $terms->getContent());
        $this->assertStringContainsString('1399604144849394', $terms->getContent());
    }

    public function test_robots_and_llms_files_exist_and_valid(): void
    {
        $this->assertFileExists(public_path('robots.txt'));
        $robots = file_get_contents(public_path('robots.txt'));
        $this->assertStringContainsString('Sitemap: https://justtriptour.com/sitemap.xml', $robots);
        $this->assertStringContainsString('Disallow: /admin', $robots);

        $this->assertFileExists(public_path('llms.txt'));
        $llms = file_get_contents(public_path('llms.txt'));
        $this->assertStringContainsString('https://justtriptour.com/packages', $llms);
        $this->assertStringNotContainsString('https://justtriptour.com/paket-tour', $llms);
    }

    public function test_duplicate_routes_point_to_canonical(): void
    {
        $homeResp = $this->get('/home');
        $homeResp->assertStatus(200);
        $this->assertStringContainsString('<link rel="canonical" href="https://justtriptour.com/">', $homeResp->getContent());

        $paketResp = $this->get('/paket-tour');
        $paketResp->assertStatus(200);
        $this->assertStringContainsString('<link rel="canonical" href="https://justtriptour.com/packages">', $paketResp->getContent());
    }
}
