<?php

namespace App\Providers;

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

    public function boot(): void
    {
        if (env('APP_ENV') === 'production' || isset($_ENV['VERCEL']) || getenv('IS_VERCEL')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
    }
}
