<?php

namespace LowB\Ladmin\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LowB\Ladmin\Facades\Ladmin;
use Illuminate\Support\Facades\View as FacadesView;
use LowB\Ladmin\Config\Facades\LadminConfig;

class AuthController
{
    public function login(Request $request): View|RedirectResponse
    {
        if ($request->method() === 'POST') {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            if (Auth::guard(config('ladmin.auth.guard'))->attempt($credentials)) {
                $request->session()->regenerate();

                return redirect()->intended(route(Ladmin::index()->routeName()));
            }

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }
        return FacadesView::first(['admin.auth.login', LadminConfig::theme() . 'auth.login']);
    }

    public function logout(): RedirectResponse
    {
        return redirect()->route(Ladmin::login()->routeName());
    }
}
