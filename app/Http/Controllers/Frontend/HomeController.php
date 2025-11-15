<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\SpecialOffer;
use App\Models\News;
use App\Models\Gallery;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get featured special offers
        // dd(Carbon::now());
        $featuredOffers = SpecialOffer::where('is_active', true)
                                     ->where('is_featured', true)
                                     ->where('valid_until', '>=', Carbon::now())
                                     ->latest()
                                     ->limit(3)
                                     ->get();

        // Get popular travel packages (Layanan)
        $popularPackages = Layanan::where('status', 'aktif')
                                 ->latest()
                                 ->take(6)
                                 ->get();

        // Get latest news/articles
        $latestNews = News::where('is_published', true)
                         ->latest()
                         ->take(3)
                         ->get();

        // Get featured news
        $featuredNews = News::where('is_published', true)
                           ->where('is_featured', true)
                           ->latest()
                           ->take(1)
                           ->first();

        // Get featured gallery images
        $featuredGallery = Gallery::where('is_public', true)
                                 ->where('status', 'active')
                                 ->where('featured', true)
                                 ->latest()
                                 ->take(6)
                                 ->get();

        // Get statistics for hero section
        $statistics = [
            'total_destinations' => Gallery::where('is_public', true)
                                          ->where('status', 'active')
                                          ->distinct('destination')
                                          ->count('destination'),
            'total_packages' => Layanan::where('status', 'aktif')->count(),
            'total_customers' => 1500, // Static for now, can be dynamic later
            'years_experience' => now()->year - 2015 // Since 2015
        ];

        // Get testimonials (using news as testimonials for now)
        $testimonials = News::where('is_published', true)
                           ->where('category', 'testimonial')
                           ->latest()
                           ->take(3)
                           ->get();

        return view('Frontend.home.index', compact(
            'featuredOffers',
            'popularPackages', 
            'latestNews',
            'featuredNews',
            'featuredGallery',
            'statistics',
            'testimonials'
        ));
    }
}