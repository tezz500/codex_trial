<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
<<<<<<< HEAD
=======
use App\Http\Middleware\EnsureLandlordAuthenticated;
use App\Http\Middleware\EnsureTenantAuthenticated;
>>>>>>> 6b9d99e43aad0905560ededa918636bb9e6a1b8a
use App\Http\Middleware\IdentifyTenant;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
<<<<<<< HEAD
=======
            'landlord.auth' => EnsureLandlordAuthenticated::class,
            'tenant.auth' => EnsureTenantAuthenticated::class,
>>>>>>> 6b9d99e43aad0905560ededa918636bb9e6a1b8a
            'tenant' => IdentifyTenant::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
