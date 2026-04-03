<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->clearStaleRouteCache();
    }

    public function boot(): void
    {
        //
    }

    /**
     * Delete stale route cache before the router loads it.
     * Runs in register() so it executes before any provider boot() or route loading.
     * Compares cache mtime against all route-related files to catch any deployment change.
     */
    private function clearStaleRouteCache(): void
    {
        $cacheFile = base_path('bootstrap/cache/routes-v7.php');

        if (! file_exists($cacheFile)) {
            return;
        }

        $cacheTime = filemtime($cacheFile);

        $watched = [
            base_path('routes/web.php'),
            base_path('routes/api.php'),
            base_path('routes/console.php'),
            base_path('bootstrap/app.php'),
        ];

        foreach ($watched as $file) {
            if (file_exists($file) && filemtime($file) > $cacheTime) {
                @unlink($cacheFile);
                return;
            }
        }
    }
}

