<?php

namespace App\Services\Sitemap;

interface SitemapServiceInterface
{
    /**
     * Generate dynamic sitemap XML content.
     */
    public function generateSitemapXml(): string;
}
