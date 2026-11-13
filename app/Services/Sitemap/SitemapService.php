<?php

namespace App\Services\Sitemap;

use App\Helpers\SeoHelper;
use App\Models\Gallery;
use App\Models\Layanan;
use App\Models\News;
use App\Models\SpecialOffer;
use Illuminate\Support\Facades\Cache;

class SitemapService implements SitemapServiceInterface
{
    /**
     * Generate dynamic sitemap XML content with 1 hour cache.
     */
    public function generateSitemapXml(): string
    {
        return Cache::remember('sitemap.xml', 3600, function () {
            $urls = [];

            // 1. Static canonical URLs
            $staticRoutes = [
                ['path' => '/', 'changefreq' => 'weekly', 'priority' => '1.0'],
                ['path' => '/packages', 'changefreq' => 'weekly', 'priority' => '0.8'],
                ['path' => '/special-offers', 'changefreq' => 'weekly', 'priority' => '0.7'],
                ['path' => '/artikel', 'changefreq' => 'weekly', 'priority' => '0.6'],
                ['path' => '/tentang-kami', 'changefreq' => 'yearly', 'priority' => '0.5'],
                ['path' => '/gallery', 'changefreq' => 'monthly', 'priority' => '0.4'],
                ['path' => '/privacy-policy', 'changefreq' => 'yearly', 'priority' => '0.3'],
                ['path' => '/terms-of-service', 'changefreq' => 'yearly', 'priority' => '0.3'],
            ];

            foreach ($staticRoutes as $item) {
                $loc = SeoHelper::absoluteUrl($item['path']);
                $urls[$loc] = [
                    'loc' => $loc,
                    'lastmod' => null,
                    'changefreq' => $item['changefreq'],
                    'priority' => $item['priority'],
                ];
            }

            // 2. Active SpecialOffer (priority on /packages/{slug})
            $specialOffers = SpecialOffer::query()
                ->where('is_active', true)
                ->whereNotNull('slug')
                ->where(function ($q) {
                    $q->whereNull('valid_until')
                        ->orWhere('valid_until', '>=', now()->startOfDay());
                })
                ->get();

            foreach ($specialOffers as $offer) {
                $loc = SeoHelper::absoluteUrl('/packages/'.$offer->slug);
                $urls[$loc] = [
                    'loc' => $loc,
                    'lastmod' => $offer->updated_at?->format('Y-m-d'),
                    'changefreq' => 'weekly',
                    'priority' => '0.8',
                ];
            }

            // 3. Active Layanan
            $layananList = Layanan::query()
                ->where('status', 'aktif')
                ->whereNotNull('slug')
                ->get();

            foreach ($layananList as $layanan) {
                $loc = SeoHelper::absoluteUrl('/packages/'.$layanan->slug);
                if (! isset($urls[$loc])) {
                    $urls[$loc] = [
                        'loc' => $loc,
                        'lastmod' => $layanan->updated_at?->format('Y-m-d'),
                        'changefreq' => 'monthly',
                        'priority' => '0.8',
                    ];
                }
            }

            // 4. Published News
            $newsList = News::published()->whereNotNull('slug')->get();
            foreach ($newsList as $news) {
                $loc = SeoHelper::absoluteUrl('/artikel/'.$news->slug);
                $urls[$loc] = [
                    'loc' => $loc,
                    'lastmod' => $news->updated_at?->format('Y-m-d'),
                    'changefreq' => 'weekly',
                    'priority' => '0.6',
                ];
            }

            // 5. Active Gallery
            $galleries = Gallery::query()
                ->where('status', 'active')
                ->whereNotNull('slug')
                ->get();

            foreach ($galleries as $gallery) {
                $loc = SeoHelper::absoluteUrl('/gallery/'.$gallery->slug);
                $urls[$loc] = [
                    'loc' => $loc,
                    'lastmod' => $gallery->updated_at?->format('Y-m-d'),
                    'changefreq' => 'monthly',
                    'priority' => '0.4',
                ];
            }

            return $this->buildXml($urls);
        });
    }

    /**
     * Build valid sitemap XML string.
     *
     * @param  array<string, array<string, ?string>>  $urls
     */
    protected function buildXml(array $urls): string
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";

        foreach ($urls as $item) {
            $xml .= '  <url>'."\n";
            $xml .= '    <loc>'.htmlspecialchars($item['loc'], ENT_XML1, 'UTF-8').'</loc>'."\n";
            if (! empty($item['lastmod'])) {
                $xml .= '    <lastmod>'.htmlspecialchars($item['lastmod'], ENT_XML1, 'UTF-8').'</lastmod>'."\n";
            }
            $xml .= '    <changefreq>'.htmlspecialchars($item['changefreq'], ENT_XML1, 'UTF-8').'</changefreq>'."\n";
            $xml .= '    <priority>'.htmlspecialchars($item['priority'], ENT_XML1, 'UTF-8').'</priority>'."\n";
            $xml .= '  </url>'."\n";
        }

        $xml .= '</urlset>';

        return $xml;
    }
}
