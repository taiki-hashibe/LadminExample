<?php

namespace LowB\Ladmin\Route;

use Illuminate\Support\Facades\Route;
use LowB\Ladmin\Crud\Crud;
use LowB\Ladmin\Facades\Ladmin;
use LowB\Ladmin\Support\Facades\LadminRoute;

trait Basically
{

    public function get(string $uri, array|string|callable|null $action = null, string $name): \Illuminate\Routing\Route
    {
        return $this->routing('get', $uri, $action, $name);
    }

    public function post(string $uri, array|string|callable|null $action = null, string $name): \Illuminate\Routing\Route
    {
        return $this->routing('post', $uri, $action, $name);
    }

    public function put(string $uri, array|string|callable|null $action = null, string $name): \Illuminate\Routing\Route
    {
        return $this->routing('put', $uri, $action, $name);
    }

    public function patch(string $uri, array|string|callable|null $action = null, string $name): \Illuminate\Routing\Route
    {
        return $this->routing('patch', $uri, $action, $name);
    }

    public function delete(string $uri, array|string|callable|null $action = null, string $name): \Illuminate\Routing\Route
    {
        return $this->routing('delete', $uri, $action, $name);
    }

    public function match(array|string $methods, string $uri, array|string|callable|null $action = null, string $name): \Illuminate\Routing\Route
    {
        $uri = LadminRoute::route($uri);
        $routeName = LadminRoute::routeName($name);
        $router = Route::match($methods, $uri, $action)->name($routeName);
        $crud = new Crud($name);
        $crud->router($router, $name);
        Ladmin::crudRegister($crud);
        return $router;
    }

    protected function routing(string $method, string $uri, array|string|callable|null $action = null, string $name): \Illuminate\Routing\Route
    {
        $uri = LadminRoute::route($uri);
        $routeName = LadminRoute::routeName($name);
        $router = Route::{$method}($uri, $action)->name($routeName);
        $crud = new Crud($name);
        $crud->router($router, $name);
        Ladmin::crudRegister($crud);
        return $router;
    }
}
