<?php

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;
use App\Models\Landlord;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        return view('landlord.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $landlord = Landlord::where('email', $credentials['email'])->first();

        if (! $landlord || ! Hash::check($credentials['password'], $landlord->password)) {
            return back()->withErrors([
                'email' => 'Invalid credentials.',
            ]);
        }

        $request->session()->put('landlord_id', $landlord->id);

        return redirect()->route('landlord.dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->forget('landlord_id');

        return redirect()->route('landlord.login');
    }
}
