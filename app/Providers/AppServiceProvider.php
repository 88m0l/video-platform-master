<?php

namespace App\Providers;

use Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
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
        Gate::define('update-videos', function ($user) {
            return $user->isAdmin() || $user->isSuperAdmin();
        });


        Gate::define('update-users', function ($user) {
            return $user->isSuperAdmin();
        });

    }
}
