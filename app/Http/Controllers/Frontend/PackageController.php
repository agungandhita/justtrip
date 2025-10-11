<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\SpecialOffer;
use App\Models\Layanan;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display the packages page.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Get active special offers
        $specialOffersQuery = SpecialOffer::where('is_active', true)
                                         ->where('valid_until', '>=', now());

        // Search functionality for special offers
        if ($request->filled('search')) {
            $search = $request->search;
            $specialOffersQuery->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by featured
        if ($request->filled('featured') && $request->featured == '1') {
            $specialOffersQuery->where('is_featured', true);
        }

        // Sort options
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'price_low':
                $specialOffersQuery->orderBy('discounted_price', 'asc');
                break;
            case 'price_high':
                $specialOffersQuery->orderBy('discounted_price', 'desc');
                break;
            case 'discount':
                $specialOffersQuery->orderBy('discount_percentage', 'desc');
                break;
            case 'ending_soon':
                $specialOffersQuery->orderBy('valid_until', 'asc');
                break;
            default:
                $specialOffersQuery->latest();
                break;
        }

        $specialOffers = $specialOffersQuery->paginate(12);

        // Process images for special offers
        $specialOffers->getCollection()->transform(function($offer) {
            $offer->processed_image = $offer->image ? asset('storage/' . $offer->image) : null;
            return $offer;
        });

        // Get featured special offers for hero section
        $featuredOffers = SpecialOffer::where('is_active', true)
                                     ->where('valid_until', '>=', now())
                                     ->where('is_featured', true)
                                     ->latest()
                                     ->take(3)
                                     ->get();

        // Process images for featured offers
        $featuredOffers->transform(function($offer) {
            $offer->processed_image = $offer->image ? asset('storage/' . $offer->image) : null;
            return $offer;
        });

        // Get regular travel packages (Layanan)
        $regularPackages = Layanan::where('status', 'aktif')
                                 ->latest()
                                 ->take(6)
                                 ->get();

        // Process images for regular packages
        $regularPackages->transform(function($package) {
            $package->processed_image = $package->gambar ? asset('storage/' . $package->gambar) : null;
            return $package;
        });

        // Get price ranges for filtering
        $priceRanges = [
            ['min' => 0, 'max' => 1000000, 'label' => 'Di bawah Rp 1 Juta'],
            ['min' => 1000000, 'max' => 5000000, 'label' => 'Rp 1 - 5 Juta'],
            ['min' => 5000000, 'max' => 10000000, 'label' => 'Rp 5 - 10 Juta'],
            ['min' => 10000000, 'max' => null, 'label' => 'Di atas Rp 10 Juta']
        ];

        return view('Frontend.packages.index', compact(
            'specialOffers', 
            'featuredOffers', 
            'regularPackages', 
            'priceRanges'
        ));
    }

    /**
     * Display the specified package.
     */
    public function show($slug)
    {
        // Try to find in special offers first
        $package = SpecialOffer::where('slug', $slug)
                              ->where('is_active', true)
                              ->where('valid_until', '>=', now())
                              ->first();

        if ($package) {
            $type = 'special_offer';
            // Process image for special offer package
            $package->processed_image = $package->image ? asset('storage/' . $package->image) : null;
            
            // Get related special offers
            $relatedPackages = SpecialOffer::where('is_active', true)
                                          ->where('valid_until', '>=', now())
                                          ->where('id', '!=', $package->id)
                                          ->latest()
                                          ->take(3)
                                          ->get();
            
            // Process images for related special offers
            $relatedPackages->transform(function($relatedPackage) {
                $relatedPackage->processed_image = $relatedPackage->image ? asset('storage/' . $relatedPackage->image) : null;
                return $relatedPackage;
            });
        } else {
            // Try to find in regular packages (Layanan)
            $package = Layanan::where('slug', $slug)
                             ->where('status', 'aktif')
                             ->firstOrFail();
            $type = 'layanan';
            // Process image for layanan package
            $package->processed_image = $package->gambar ? asset('storage/' . $package->gambar) : null;
            
            // Get related layanan
            $relatedPackages = Layanan::where('status', 'aktif')
                                     ->where('layanan_id', '!=', $package->layanan_id)
                                     ->where('jenis_layanan', $package->jenis_layanan)
                                     ->latest()
                                     ->take(3)
                                     ->get();
            
            // Process images for related layanan
            $relatedPackages->transform(function($relatedPackage) {
                $relatedPackage->processed_image = $relatedPackage->gambar ? asset('storage/' . $relatedPackage->gambar) : null;
                return $relatedPackage;
            });
        }

        return view('Frontend.packages.show', compact('package', 'relatedPackages', 'type'));
    }
}