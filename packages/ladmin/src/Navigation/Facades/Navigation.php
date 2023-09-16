<?php

namespace LowB\Ladmin\Navigation\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \LowB\Ladmin\Navigation\Navigation
 */
class Navigation extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \LowB\Ladmin\Navigation\Navigation::class;
    }
}
