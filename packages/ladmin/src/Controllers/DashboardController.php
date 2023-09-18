<?php

namespace LowB\Ladmin\Controllers;

use Illuminate\Support\Facades\View;
use LowB\Ladmin\Config\Facades\LadminConfig;

class DashboardController
{
    public function show()
    {
        return View::first(['admin.dashboard', LadminConfig::theme() . 'dashboard']);
    }
}
