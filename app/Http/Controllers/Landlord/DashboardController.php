<?php

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;
use App\Models\Landlord;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $landlord = Landlord::findOrFail($request->session()->get('landlord_id'));

        return view('landlord.dashboard', [
            'landlord' => $landlord,
        ]);
    }
}
