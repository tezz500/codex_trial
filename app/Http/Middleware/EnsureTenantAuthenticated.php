<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTenantAuthenticated
{
    public function handle(Request $request, Closure $next): Response
    {
        /** @var Tenant|null $tenant */
        $tenant = $request->route('tenant');

        if (! $tenant) {
            return redirect('/');
        }

        if (! $request->session()->has('tenant_user_id') || $request->session()->get('tenant_id') !== $tenant->id) {
            return redirect()->route('tenant.login', ['tenant' => $tenant->slug]);
        }

        return $next($request);
    }
}
