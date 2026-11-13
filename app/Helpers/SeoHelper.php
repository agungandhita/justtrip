<?php

namespace App\Helpers;

class SeoHelper
{
    /**
     * Get the canonical absolute URL based on config('app.url').
     */
    public static function canonicalUrl(?string $path = null): string
    {
        $baseUrl = rtrim((string) config('app.url'), '/');

        if ($path === null) {
            $path = request()->path();
        }

        // Clean path and remove query string if passed
        $path = trim(explode('?', $path)[0], '/');

        // Canonical mapping for duplicate routes
        if ($path === '' || $path === 'home') {
            return $baseUrl.'/';
        }

        if ($path === 'paket-tour') {
            return $baseUrl.'/packages';
        }

        return $baseUrl.'/'.$path;
    }

    /**
     * Get an absolute URL using config('app.url').
     */
    public static function absoluteUrl(string $path = ''): string
    {
        $baseUrl = rtrim((string) config('app.url'), '/');
        $cleanPath = ltrim($path, '/');

        if ($cleanPath === '') {
            return $baseUrl.'/';
        }

        return $baseUrl.'/'.$cleanPath;
    }
}
