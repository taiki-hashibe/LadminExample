<?php

namespace LowB\Ladmin\Contracts;

use Illuminate\Contracts\View\View;

interface Renderable
{
    public function render(?array $params = []): View;
}
