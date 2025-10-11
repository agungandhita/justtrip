<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\SpecialOffer;
use Illuminate\Support\Facades\Cache;

class NavbarComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        // Cache special offers for navbar for 15 minutes
        $navbarOffers = Cache::remember('navbar_special_offers', 900, function () {
            return SpecialOffer::with('layanan')
                ->where('is_active', true)
                ->where('valid_until', '>=', now())
                ->orderBy('is_featured', 'desc')
                ->orderBy('discount_percentage', 'desc')
                ->take(4)
                ->get();
        });

        // Cache mobile offers for navbar for 15 minutes
        $mobileOffers = Cache::remember('navbar_mobile_offers', 900, function () {
            return SpecialOffer::with('layanan')
                ->where('is_active', true)
                ->where('valid_until', '>=', now())
                ->orderBy('is_featured', 'desc')
                ->orderBy('discount_percentage', 'desc')
                ->take(2)
                ->get();
        });

        $view->with([
            'navbarOffers' => $navbarOffers,
            'mobileOffers' => $mobileOffers
        ]);
    }
}