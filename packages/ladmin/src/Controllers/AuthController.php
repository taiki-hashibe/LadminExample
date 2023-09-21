<?php

namespace LowB\Ladmin\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View as FacadesView;
use LowB\Ladmin\Support\Facades\LadminRoute;

class AuthController extends Controller
{
    public function login(Request $request): View|RedirectResponse
    {
        return FacadesView::first([config('ladmin.view.prefix') . '.auth.login', 'ladmin::auth.login']);
    }

    public function register(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard(config('ladmin.guard'))->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(route(LadminRoute::dashboard()->index()->name));
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard(config('ladmin.guard'))->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect()->route(LadminRoute::auth()->login()->name);
    }
}
