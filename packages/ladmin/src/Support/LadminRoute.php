<?php

namespace LowB\Ladmin\Support;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use LowB\Ladmin\Crud\Crud;
use LowB\Ladmin\Navigation\Facades\Navigation;

class LadminRoute
{
    protected array $routes = [];

    public function addRoute(string $route)
    {
        $this->routes[] = $route;
        $this->routes = array_unique($this->routes);
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function crud(string $modelClassOrTableName)
    {
        $this->show($modelClassOrTableName);
        $this->detail($modelClassOrTableName);
        return $this;
    }

    public function show(string $modelClassOrTableName)
    {
        $instance = app()->make($modelClassOrTableName);
        if ($instance instanceof Model) {
            $crud = new Crud();
            $crud->model($instance)->show();
            Route::get($crud->getRoute(), function (Request $request) use ($crud) {
                return $crud->getController()->show($request);
            })->name($crud->getRouteName());
            $this->addRoute($crud->getRoute());
            Navigation::addHeaderNavigation($crud);
            Navigation::addFooterNavigation($crud);
        };
        return $this;
    }

    public function detail(string $modelClassOrTableName)
    {
        $instance = app()->make($modelClassOrTableName);
        if ($instance instanceof Model) {
            $crud = new Crud();
            $crud->model($instance)->detail();
            Route::get($crud->getRoute(), function (Request $request) use ($crud) {
                return $crud->getController()->detail($request);
            })->name($crud->getRouteName());
            $this->addRoute($crud->getRoute());
        };
        return $this;
    }

    public function navigation(string $key)
    {
    }
}
