<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\SpecialOffer;
use Illuminate\Http\Request;

class SpecialOfferController extends Controller
{
    /**
     * Display the special offers index page.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Get active special offers
        $specialOffersQuery = SpecialOffer::where('is_active', true)
                                         ->where('valid_until', '>=', now())
                                         ->with('layanan');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $specialOffersQuery->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('layanan', function($layananQuery) use ($search) {
                      $layananQuery->where('nama_layanan', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $specialOffersQuery->whereHas('layanan', function($layananQuery) use ($request) {
                $layananQuery->where('kategori', $request->category);
            });
        }

        // Filter by featured
        if ($request->filled('featured') && $request->featured == '1') {
            $specialOffersQuery->where('is_featured', true);
        }

        // Filter by price range
        if ($request->filled('price_min')) {
            $specialOffersQuery->where('discounted_price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $specialOffersQuery->where('discounted_price', '<=', $request->price_max);
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
                                     ->with('layanan')
                                     ->latest()
                                     ->take(3)
                                     ->get();

        // Process images for featured offers
        $featuredOffers->transform(function($offer) {
            $offer->processed_image = $offer->image ? asset('storage/' . $offer->image) : null;
            return $offer;
        });

        // Get categories for filter
        $categories = SpecialOffer::where('is_active', true)
                                 ->where('valid_until', '>=', now())
                                 ->with('layanan')
                                 ->get()
                                 ->pluck('layanan.kategori')
                                 ->unique()
                                 ->filter()
                                 ->sort()
                                 ->values();

        // Get price ranges for filtering
        $priceRanges = [
            ['min' => 0, 'max' => 1000000, 'label' => 'Di bawah Rp 1 Juta'],
            ['min' => 1000000, 'max' => 5000000, 'label' => 'Rp 1 - 5 Juta'],
            ['min' => 5000000, 'max' => 10000000, 'label' => 'Rp 5 - 10 Juta'],
            ['min' => 10000000, 'max' => null, 'label' => 'Di atas Rp 10 Juta']
        ];

        // Get the longest valid_until date for countdown timer
        $longestValidUntil = SpecialOffer::where('is_active', true)
                                        ->where('valid_until', '>=', now())
                                        ->orderBy('valid_until', 'desc')
                                        ->value('valid_until');

        return view('Frontend.special-offers.index', compact(
            'specialOffers', 
            'featuredOffers', 
            'categories',
            'priceRanges',
            'longestValidUntil'
        ));
    }

    /**
     * Display the specified special offer.
     */
    public function show(SpecialOffer $specialOffer)
    {
        // Check if offer is active and valid
        if (!$specialOffer->is_active || $specialOffer->valid_until < now()) {
            abort(404, 'Special offer not found or expired');
        }

        // Load related data
        $specialOffer->load(['layanan', 'galleries' => function($query) {
            $query->orderedBySort();
        }]);

        // Process image
        $specialOffer->processed_image = $specialOffer->image ? asset('storage/' . $specialOffer->image) : null;

        // Get related special offers
        $relatedOffers = SpecialOffer::where('is_active', true)
                                    ->where('valid_until', '>=', now())
                                    ->where('id', '!=', $specialOffer->id)
                                    ->with('layanan')
                                    ->latest()
                                    ->take(3)
                                    ->get();

        // Process images for related offers
        $relatedOffers->transform(function($offer) {
            $offer->processed_image = $offer->image ? asset('storage/' . $offer->image) : null;
            return $offer;
        });

        return view('Frontend.special-offers.show', compact('specialOffer', 'relatedOffers'));
    }
}