<?php

namespace LowB\Ladmin\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use LowB\Ladmin\Facades\Ladmin;

class ProfileController
{
    public function index()
    {
        return view('ladmin::profile.index');
    }

    public function profileUpdate(Request $request)
    {
        Auth::user()->update([
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

    public function destroy()
    {
        Auth::user()->delete();
        return redirect()->route(Ladmin::login()->getRouteName());
    }
}
