<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/Web/web.php',
        api:[
            __DIR__ . '/../routes/Api/api.php',
            __DIR__ . '/../routes/Organization/organization.php',
            __DIR__ . '/../routes/Shafiean/shafiean.php',
            ],
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->append(\App\Http\Middleware\CheckOrganization::class)->except('shafiean/*');
        $middleware->api(append :\Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
