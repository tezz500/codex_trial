<?php

use App\Models\Tenant;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('tenant')
    ->prefix('{tenant:slug}')
    ->group(function () {
        Route::get('/', function (Tenant $tenant) {
            return response()->json([
                'message' => 'Tenant dashboard',
                'tenant' => [
                    'id' => $tenant->id,
                    'name' => $tenant->name,
                    'slug' => $tenant->slug,
                ],
            ]);
        });
    });
