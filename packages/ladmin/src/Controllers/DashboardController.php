<?php

namespace LowB\Ladmin\Controllers;

use Illuminate\Contracts\View\View as ViewView;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    public function index(): ViewView
    {
        return View::first([
            config('ladmin.view.prefix') . '.dashboard',
            'ladmin::dashboard'
        ]);
    }
}
