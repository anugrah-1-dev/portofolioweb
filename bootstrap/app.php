<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\SecurityHeaders;

// Delete stale route cache unconditionally so it's never served stale after git pull.
// Route loading from web.php has negligible overhead for a portfolio-sized app.
$routeCache = __DIR__ . '/cache/routes-v7.php';

if (is_file($routeCache)) {
    @unlink($routeCache);
}

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo('/admin/login');
        $middleware->append(SecurityHeaders::class);
        $middleware->validateCsrfTokens(except: [
            'webhook/midtrans',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
