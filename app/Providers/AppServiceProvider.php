<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (config('app.env') !== 'local') {
            URL::forceScheme('https');
        }
        // Register any application services here.
    }

    /**
     * Bootstrap any application services.
     */

    public function boot(): void
    {
        Carbon::setLocale('fr');
    }
}
