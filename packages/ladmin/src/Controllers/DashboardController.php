<?php

namespace LowB\Ladmin\Controllers;

use Illuminate\Contracts\View\View as ViewView;
use Illuminate\Support\Facades\View;
use LowB\Ladmin\Config\Facades\LadminConfig;

class DashboardController
{
    public function show(): ViewView
    {
        return View::first(['admin.dashboard', LadminConfig::theme() . 'dashboard']);
    }
}
