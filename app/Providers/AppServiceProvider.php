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

        // Use a Laravel-served media URL so uploaded files work even without storage symlink
        // and on hosts that expose the app under /public path.
        if (! app()->runningInConsole()) {
            config(['filesystems.disks.public.url' => url('media')]);
        }
    }
}

