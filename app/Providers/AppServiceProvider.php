<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use RealRashid\SweetAlert\SweetAlertServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(SweetAlertServiceProvider::class);
        $this->app->alias('alert', \RealRashid\SweetAlert\Facades\Alert::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register view composer for navbar special offers
        view()->composer('Frontend.partials.navbar', \App\Http\View\Composers\NavbarComposer::class);
    }
}
