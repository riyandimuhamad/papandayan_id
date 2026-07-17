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

        try {
            $settings = \App\Models\Setting::all()->keyBy('key');
            \Illuminate\Support\Facades\View::share('settings', $settings);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\View::share('settings', collect([]));
        }
    }
}
