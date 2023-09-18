<?php

namespace LowB\Ladmin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LowB\Ladmin\Facades\Ladmin;

class ProfileController extends Controller
{
    public function show()
    {
        return view('ladmin::profile.index', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        Auth::user()->update([
            'name' => $request->name,
            'email' => $request->email
        ]);
        return back()->with('status', 'profile updated');
    }

    public function destroy(): RedirectResponse
    {
        Auth::user()->delete();
        return redirect()->route(Ladmin::login()->getRouteName());
    }
}
