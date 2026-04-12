<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Force HTTPS on all generated URLs when running in production.
        // Prevents mixed-content warnings and ensures session cookies are sent securely.
        if (app()->isProduction()) {
            URL::forceScheme('https');
        }


    }
}

