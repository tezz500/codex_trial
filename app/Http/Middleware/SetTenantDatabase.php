<?php

namespace App\Http\Middleware;

use App\Support\CurrentTenant;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class SetTenantDatabase
{
    public function __construct(private CurrentTenant $currentTenant)
    {
    }

    public function handle(Request $request, Closure $next): Response
    {
        $tenant = $this->currentTenant->get();

        if (! $tenant) {
            return $next($request);
        }

        $driver = config('tenancy.tenant_connection', 'mysql');
        $baseConnection = config("database.connections.{$driver}");

        if (! is_array($baseConnection)) {
            return $next($request);
        }

        $connection = array_merge($baseConnection, [
            'host' => $tenant->db_host ?? $baseConnection['host'] ?? null,
            'database' => $tenant->db_database ?? $baseConnection['database'] ?? null,
            'username' => $tenant->db_username ?? $baseConnection['username'] ?? null,
            'password' => $tenant->db_password ?? $baseConnection['password'] ?? null,
        ]);

        Config::set('database.connections.tenant', $connection);
        DB::purge('tenant');
        DB::reconnect('tenant');

        return $next($request);
    }
}
