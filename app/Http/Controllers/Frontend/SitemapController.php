<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\Sitemap\SitemapServiceInterface;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __construct(
        protected SitemapServiceInterface $sitemapService
    ) {}

    /**
     * Return dynamic sitemap XML.
     */
    public function index(): Response
    {
        $xml = $this->sitemapService->generateSitemapXml();

        return response($xml, 200, [
            'Content-Type' => 'application/xml',
        ]);
    }
}
