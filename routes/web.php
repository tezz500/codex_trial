<?php

use App\Http\Controllers\Landlord\AuthController as LandlordAuthController;
use App\Http\Controllers\Landlord\DashboardController as LandlordDashboardController;
use App\Http\Controllers\Tenant\AuthController as TenantAuthController;
use App\Http\Controllers\Tenant\DashboardController as TenantDashboardController;
use App\Models\Tenant;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('landlord')->group(function () {
    Route::get('login', [LandlordAuthController::class, 'showLogin'])->name('landlord.login');
    Route::post('login', [LandlordAuthController::class, 'login'])->name('landlord.login.submit');
    Route::post('logout', [LandlordAuthController::class, 'logout'])->name('landlord.logout');

    Route::middleware('landlord.auth')->group(function () {
        Route::get('dashboard', LandlordDashboardController::class)->name('landlord.dashboard');
    });
});

Route::middleware(['tenant', 'tenant.db'])->group(function () {
    Route::get('login', [TenantAuthController::class, 'showLogin'])->name('tenant.login');
    Route::post('login', [TenantAuthController::class, 'login'])->name('tenant.login.submit');

    Route::middleware('tenant.auth')->group(function () {
        Route::get('dashboard', TenantDashboardController::class)->name('tenant.dashboard');
        Route::post('logout', [TenantAuthController::class, 'logout'])->name('tenant.logout');
    });
});
