<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\TenantUser;
use App\Support\CurrentTenant;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(private CurrentTenant $currentTenant)
    {
    }

    public function __invoke(Request $request): View
    {
        $tenant = $this->currentTenant->get();
        abort_unless($tenant, 404);

        $tenantUser = TenantUser::findOrFail($request->session()->get('tenant_user_id'));

        return view('tenant.dashboard', [
            'tenant' => $tenant,
            'tenantUser' => $tenantUser,
        ]);
    }
}
