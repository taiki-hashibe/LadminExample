<?php

namespace LowB\Ladmin\Crud\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \LowB\Ladmin\Crud\Route
 */
class Route extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \LowB\Ladmin\Crud\Route::class;
    }
}
