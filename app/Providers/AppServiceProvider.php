<?php

namespace App\Providers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->clearStaleRouteCache();
    }

    /**
     * Clear route cache automatically if routes/web.php is newer than the cache.
     * Prevents MethodNotAllowedHttpException caused by stale cached routes on shared hosting.
     */
    private function clearStaleRouteCache(): void
    {
        if (! app()->routesAreCached()) {
            return;
        }

        $cacheFile = base_path('bootstrap/cache/routes-v7.php');
        $routeFile = base_path('routes/web.php');

        if (file_exists($cacheFile) && file_exists($routeFile) && filemtime($routeFile) > filemtime($cacheFile)) {
            Artisan::call('route:clear');
        }
    }
}
