<?php

namespace App\Http\Middleware;

use App\Support\CurrentTenant;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTenantAuthenticated
{
    public function __construct(private CurrentTenant $currentTenant)
    {
    }

    public function handle(Request $request, Closure $next): Response
    {
        $tenant = $this->currentTenant->get();

        if (! $tenant) {
            abort(404);
        }

        if (! $request->session()->has('tenant_user_id') || $request->session()->get('tenant_id') !== $tenant->id) {
            return redirect()->route('tenant.login', ['tenant' => $tenant->slug]);
        }

        return $next($request);
    }
}
