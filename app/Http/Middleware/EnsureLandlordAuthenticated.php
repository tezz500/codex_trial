<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureLandlordAuthenticated
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->session()->has('landlord_id')) {
            return redirect()->route('landlord.login');
        }

        return $next($request);
    }
}
