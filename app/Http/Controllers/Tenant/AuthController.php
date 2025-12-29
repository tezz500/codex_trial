<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\TenantUser;
use App\Support\CurrentTenant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function __construct(private CurrentTenant $currentTenant)
    {
    }

    public function showLogin(): View
    {
        $tenant = $this->currentTenant->get();

        abort_unless($tenant, 404);

        return view('tenant.login', [
            'tenant' => $tenant,
        ]);
    }

    public function login(Request $request): RedirectResponse
    {
        $tenant = $this->currentTenant->get();

        abort_unless($tenant, 404);

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $tenantUser = TenantUser::where('tenant_id', $tenant->id)
            ->where('email', $credentials['email'])
            ->first();

        if (! $tenantUser || ! Hash::check($credentials['password'], $tenantUser->password)) {
            return back()->withErrors([
                'email' => 'Invalid credentials.',
            ]);
        }

        $request->session()->put('tenant_user_id', $tenantUser->id);
        $request->session()->put('tenant_id', $tenant->id);

        return redirect()->route('tenant.dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        $tenant = $this->currentTenant->get();
        abort_unless($tenant, 404);

        $request->session()->forget(['tenant_user_id', 'tenant_id']);

        return redirect()->route('tenant.login');
    }
}
