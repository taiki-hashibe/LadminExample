<?php

namespace LowB\Ladmin\Controllers;

use Illuminate\Support\Facades\View;

class DashboardController
{
    public function show()
    {
        return View::first(['admin.dashboard', 'ladmin::dashboard']);
    }
}
