<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\SpecialOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpecialOfferController extends Controller
{
    /**
     * Display the special offers page.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Get active special offers
        $specialOffersQuery = SpecialOffer::with('layanan')
                                         ->where('is_active', true)
                                         ->where('valid_until', '>=', now());

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $specialOffersQuery->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('layanan', function($layananQuery) use ($search) {
                      $layananQuery->where('lokasi_tujuan', 'like', "%{$search}%")
                                  ->orWhere('nama_layanan', 'like', "%{$search}%");
                  });
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

        // Filter by destination
        if ($request->filled('destination')) {
            $specialOffersQuery->whereHas('layanan', function($layananQuery) use ($request) {
                $layananQuery->where('lokasi_tujuan', 'like', "%{$request->destination}%");
            });
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
            case 'featured':
                $specialOffersQuery->orderBy('is_featured', 'desc')
                                  ->orderBy('created_at', 'desc');
                break;
            default:
                $specialOffersQuery->latest();
                break;
        }

        $specialOffers = $specialOffersQuery->paginate(12);

        // Get popular destinations for filter
        $popularDestinations = SpecialOffer::with('layanan')
                                          ->where('is_active', true)
                                          ->where('valid_until', '>=', now())
                                          ->get()
                                          ->pluck('layanan.lokasi_tujuan')
                                          ->filter()
                                          ->unique()
                                          ->take(10);

        // Get price ranges for filtering
        $priceRanges = [
            ['min' => 0, 'max' => 1000000, 'label' => 'Di bawah Rp 1 Juta'],
            ['min' => 1000000, 'max' => 5000000, 'label' => 'Rp 1 - 5 Juta'],
            ['min' => 5000000, 'max' => 10000000, 'label' => 'Rp 5 - 10 Juta'],
            ['min' => 10000000, 'max' => null, 'label' => 'Di atas Rp 10 Juta']
        ];

        // Statistics for display
        $totalOffers = SpecialOffer::where('is_active', true)
                                  ->where('valid_until', '>=', now())
                                  ->count();
        
        $maxDiscount = SpecialOffer::where('is_active', true)
                                  ->where('valid_until', '>=', now())
                                  ->max('discount_percentage');

        $endingSoonCount = SpecialOffer::where('is_active', true)
                                      ->where('valid_until', '>=', now())
                                      ->where('valid_until', '<=', now()->addDays(7))
                                      ->count();

        return view('Frontend.special-offers.index', compact(
            'specialOffers',
            'popularDestinations',
            'priceRanges',
            'totalOffers',
            'maxDiscount',
            'endingSoonCount'
        ));
    }

    /**
     * Display the specified special offer.
     */
    public function show($slug)
    {
        $specialOffer = SpecialOffer::with('layanan')
                                   ->where('slug', $slug)
                                   ->where('is_active', true)
                                   ->where('valid_until', '>=', now())
                                   ->firstOrFail();

        // Get related special offers
        $relatedOffers = SpecialOffer::with('layanan')
                                    ->where('is_active', true)
                                    ->where('valid_until', '>=', now())
                                    ->where('id', '!=', $specialOffer->id)
                                    ->when($specialOffer->layanan, function($query) use ($specialOffer) {
                                        // Prioritize offers from the same destination
                                        $query->whereHas('layanan', function($layananQuery) use ($specialOffer) {
                                            $layananQuery->where('lokasi_tujuan', $specialOffer->layanan->lokasi_tujuan);
                                        });
                                    })
                                    ->latest()
                                    ->take(3)
                                    ->get();

        // If not enough related offers from same destination, get more general ones
        if ($relatedOffers->count() < 3) {
            $additionalOffers = SpecialOffer::with('layanan')
                                           ->where('is_active', true)
                                           ->where('valid_until', '>=', now())
                                           ->where('id', '!=', $specialOffer->id)
                                           ->whereNotIn('id', $relatedOffers->pluck('id'))
                                           ->latest()
                                           ->take(3 - $relatedOffers->count())
                                           ->get();
            
            $relatedOffers = $relatedOffers->merge($additionalOffers);
        }

        return view('Frontend.packages.show', compact('specialOffer', 'relatedOffers'))
               ->with('package', $specialOffer)
               ->with('relatedPackages', $relatedOffers)
               ->with('type', 'special_offer');
    }

    /**
     * Get special offers data for AJAX requests
     */
    public function getData(Request $request)
    {
        $specialOffers = SpecialOffer::with('layanan')
                                    ->where('is_active', true)
                                    ->where('valid_until', '>=', now());

        if ($request->filled('featured')) {
            $specialOffers->where('is_featured', true);
        }

        if ($request->filled('limit')) {
            $specialOffers->take($request->limit);
        }

        $offers = $specialOffers->latest()->get();

        return response()->json([
            'success' => true,
            'data' => $offers->map(function($offer) {
                return [
                    'id' => $offer->id,
                    'title' => $offer->title,
                    'slug' => $offer->slug,
                    'description' => $offer->description,
                    'image' => $offer->image ? asset('storage/' . $offer->image) : null,
                    'original_price' => $offer->original_price,
                    'discounted_price' => $offer->discounted_price,
                    'discount_percentage' => $offer->discount_percentage,
                    'valid_until' => $offer->valid_until->format('Y-m-d'),
                    'valid_until_formatted' => $offer->valid_until->format('d M Y'),
                    'is_featured' => $offer->is_featured,
                    'destination' => $offer->layanan ? $offer->layanan->lokasi_tujuan : null,
                    'days_left' => now()->diffInDays($offer->valid_until, false),
                    'url' => route('packages.show', $offer->slug),
                    'booking_url' => Auth::check() ? route('booking.create-from-offer', $offer->id) : route('login')
                ];
            })
        ]);
    }
}