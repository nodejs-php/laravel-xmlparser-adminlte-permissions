<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
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
        'App\Models\Offer' => 'App\Policies\OfferPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // define gates

        Gate::define('admin',function($user){
            return $user->hasRole('admin');
        });
        Gate::define('editor',function($user){
            return $user->hasRole('editor');
        });
        Gate::define('author',function($user){
            return $user->hasRole('author');
        });
    }
}
