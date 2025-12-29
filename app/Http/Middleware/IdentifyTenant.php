<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use App\Support\CurrentTenant;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class IdentifyTenant
{
    public function __construct(private CurrentTenant $currentTenant)
    {
    }

    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->getHost();
        $tenant = Tenant::query()->where('domain', $host)->first();

        if (! $tenant) {
            $landlordDomain = config('tenancy.landlord_domain');
            if ($landlordDomain && Str::endsWith($host, '.'.$landlordDomain)) {
                $subdomain = Str::before($host, '.'.$landlordDomain);
                if ($subdomain !== 'www' && $subdomain !== '') {
                    $tenant = Tenant::query()->where('slug', $subdomain)->first();
                }
            }
        }

        if ($tenant) {
            $this->currentTenant->set($tenant);
        } else {
            $this->currentTenant->set(null);
        }

        return $next($request);
    }
}
