<?php

namespace LowB\Ladmin\View\Composers;

use Illuminate\View\View;
use LowB\Ladmin\Navigation\Facades\Navigation;

class AuthLayoutComposer
{
    public function compose(View $view): void
    {
        $view->with([
            'dropdown' => Navigation::getDropdown(),
            'headerNavigation' => Navigation::getHeaderNavigation(),
            'footerNavigation' => Navigation::getFooterNavigation()
        ]);
    }
}
