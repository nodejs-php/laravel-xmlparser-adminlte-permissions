<?php

namespace App\Providers;

use App\Repositories\ProductImagesRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\DB;
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
        DB::listen(function ($query) {
            \Log::info($query->sql, ['bindings' => $query->bindings, 'time' => $query->time]);
        });
    }
}
