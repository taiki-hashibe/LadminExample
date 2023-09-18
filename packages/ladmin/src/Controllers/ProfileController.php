<?php

namespace LowB\Ladmin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LowB\Ladmin\Facades\Ladmin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

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
        $request->user()->update([
            'name' => $request->name,
            'email' => $request->email
        ]);
        return back()->with('status', 'profile updated');
    }

    public function passwordUpdate(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->user()->delete();
        return redirect()->route(Ladmin::login()->getRouteName());
    }
}
