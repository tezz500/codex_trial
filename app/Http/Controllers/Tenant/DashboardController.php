<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\TenantUser;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request, Tenant $tenant): View
    {
        $tenantUser = TenantUser::findOrFail($request->session()->get('tenant_user_id'));

        return view('tenant.dashboard', [
            'tenant' => $tenant,
            'tenantUser' => $tenantUser,
        ]);
    }
}
