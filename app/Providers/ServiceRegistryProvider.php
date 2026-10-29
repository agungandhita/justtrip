<?php

namespace App\Providers;

use App\Services\Inquiry\InquiryInterface;
use App\Services\Inquiry\InquiryService;
use App\Services\Inquiry\InquiryServiceInterface;
use Illuminate\Support\ServiceProvider;

class ServiceRegistryProvider extends ServiceProvider
{
    /**
     * All of the container bindings that should be registered.
     *
     * @var array<string, string>
     */
    public array $bindings = [
        InquiryServiceInterface::class => InquiryService::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
