<?php

namespace LowB\Ladmin\View\Composers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthLayoutComposer
{
    public Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function compose(View $view): void
    {
        $view->with([]);
    }
}
