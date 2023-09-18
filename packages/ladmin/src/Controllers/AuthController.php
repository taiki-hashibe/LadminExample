<?php

namespace LowB\Ladmin\Controllers;

use LowB\Ladmin\Support\Facades\LadminRoute;

class AuthController
{
    public function login()
    {
        return view('ladmin::login');
    }

    public function logout()
    {
        return redirect()->route(LadminRoute::route(config('ladmin.route.logout'), null, false));
    }
}
