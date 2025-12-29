<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\EnsureLandlordAuthenticated;
use App\Http\Middleware\EnsureTenantAuthenticated;
use App\Http\Middleware\IdentifyTenant;
use App\Http\Middleware\SetTenantDatabase;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'landlord.auth' => EnsureLandlordAuthenticated::class,
            'tenant.auth' => EnsureTenantAuthenticated::class,
            'tenant' => IdentifyTenant::class,
            'tenant.db' => SetTenantDatabase::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
