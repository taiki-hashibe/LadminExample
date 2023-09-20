<?php

namespace LowB\Ladmin\Crud;

use Illuminate\Support\Facades\Route as FacadesRoute;

class Route
{
    private array $routes;

    public function __call($method, $args)
    {
        $router = FacadesRoute::{$method}(...$args);
        $this->routes[] = $router;
        return $router;
    }
}
