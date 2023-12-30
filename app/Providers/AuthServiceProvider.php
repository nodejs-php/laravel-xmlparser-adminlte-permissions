<?php

namespace App\Providers;

use App\Models\CategoriesOffers;
use App\Policies\OfferPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        CategoriesOffers::class => OfferPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('admin',function($user){
            return $user->hasRole('admin');
        });
        Gate::define('data-loader',function($user){
            return $user->hasRole('api-loader');
        });
        Gate::define('data-viewer',function($user){
            return $user->hasRole('data-viewer');
        });
    }
}
