<?php

namespace LowB\Ladmin\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LowB\Ladmin\Facades\Ladmin;
use LowB\Ladmin\Support\Facades\LadminRoute;

class AuthController
{
    public function login(Request $request)
    {
        if ($request->method() === 'POST') {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            if (Auth::guard(config('ladmin.auth.guard'))->attempt($credentials)) {
                $request->session()->regenerate();

                return redirect()->intended(route(Ladmin::index()->getRouteName()));
            }

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }
        return view('ladmin::auth.login');
    }

    public function logout()
    {
        return redirect()->route(Ladmin::login()->getRouteName());
    }
}
