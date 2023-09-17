<?php

namespace LowB\Ladmin\View\Composers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use LowB\Ladmin\Navigation\Facades\Navigation;

class AuthLayoutComposer
{
    public Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function compose(View $view): void
    {
        dump($this->request->path());
        $view->with([
            'dropdown' => Navigation::getDropdown(),
            'headerNavigation' => Navigation::getHeaderNavigation(),
            'footerNavigation' => Navigation::getFooterNavigation()
        ]);
    }
}
