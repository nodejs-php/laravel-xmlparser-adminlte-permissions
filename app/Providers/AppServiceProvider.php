<?php

namespace App\Providers;

use App\Repositories\OfferRepository;
use App\Repositories\ProductImagesRepository;
use App\Repositories\ProductRepository;
use App\Services\APIService;
use App\Services\MapperService;
use App\Services\ParserService;
use App\Services\XmlParser;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
