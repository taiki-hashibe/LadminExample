<?php

namespace LowB\Ladmin;

use Illuminate\Support\Facades\Request;
use LowB\Ladmin\Crud\Crud;

class Ladmin
{
    public array $crudList = [];
    protected array $routes = [];
    protected array $routeNames = [];

    public function addRoute(string $route)
    {
        $this->routes[] = $route;
        $this->routes = array_unique($this->routes);
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function addRouteName(string $routeName)
    {
        $this->routeNames[] = $routeName;
        $this->routeNames = array_unique($this->routeNames);
    }

    public function getRouteNames()
    {
        return $this->routeNames;
    }

    public function crud()
    {
        foreach ($this->crudList as $crud) {
            if (Request::routeIs($crud->getRouteName())) {
                return $crud;
            }
        }
    }

    public function crudRegister(Crud $crud)
    {
        $this->crudList[] = $crud;
    }

    public function getNavigation(string|null $key = null)
    {
        if (!$key) {
            return $this->crudList;
        }
        $navigation = [];
        foreach ($this->crudList as $crud) {
            if (in_array($key, $crud->getNavigation())) {
                $navigation[] = $crud;
            }
        }
        return $navigation;
    }
}
