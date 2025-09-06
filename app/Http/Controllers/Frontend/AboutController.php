<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Gallery;
use App\Models\Layanan;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display the about page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get company history/milestones (using news with specific category)
        $companyHistory = News::where('is_published', true)
                             ->where('category', 'company-history')
                             ->orderBy('created_at', 'asc')
                             ->get();

        // Get team members (using news with team category)
        $teamMembers = News::where('is_published', true)
                          ->where('category', 'team')
                          ->latest()
                          ->get();

        // Get company achievements/awards (using news)
        $achievements = News::where('is_published', true)
                           ->where('category', 'achievement')
                           ->latest()
                           ->take(6)
                           ->get();

        // Get testimonials
        $testimonials = News::where('is_published', true)
                           ->where('category', 'testimonial')
                           ->latest()
                           ->take(5)
                           ->get();

        // Get gallery images for about page
        $aboutGallery = Gallery::where('is_public', true)
                              ->where('status', 'active')
                              ->where('category', 'about')
                              ->latest()
                              ->take(8)
                              ->get();

        // Get company statistics
        $statistics = [
            'years_experience' => now()->year - 2015, // Since 2015
            'total_destinations' => Gallery::where('is_public', true)
                                          ->where('status', 'active')
                                          ->distinct('destination')
                                          ->count('destination'),
            'total_packages' => Layanan::where('status', 'aktif')->count(),
            'happy_customers' => 1500, // Static for now
            'expert_guides' => 25, // Static for now
            'countries_covered' => 15 // Static for now
        ];

        // Get services overview
        $services = Layanan::where('status', 'aktif')
                          ->select('layanan_id', 'nama_layanan', 'deskripsi', 'harga_mulai', 'gambar_destinasi')
                          ->latest()
                          ->take(6)
                          ->get();

        // Get company values/mission (using news)
        $companyValues = News::where('is_published', true)
                            ->where('category', 'company-values')
                            ->latest()
                            ->get();

        return view('Frontend.about.index', compact(
            'companyHistory',
            'teamMembers',
            'achievements',
            'testimonials',
            'aboutGallery',
            'statistics',
            'services',
            'companyValues'
        ));
    }
}