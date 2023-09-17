<?php

namespace LowB\Ladmin\Route;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use LowB\Ladmin\Controllers\DashboardController;
use LowB\Ladmin\Crud\Crud;
use LowB\Ladmin\Facades\Ladmin;
use LowB\Ladmin\Support\Facades\LadminRoute as SupportLadminRoute;

class LadminRoute
{

    public function get(string $uri, array|string|callable|null $action = null, string $name)
    {
        $routeName = SupportLadminRoute::routeName($name);
        Route::get($uri, $action)->name($routeName);
        Ladmin::addRoute($uri);
        Ladmin::addRouteName($routeName);
    }

    public function post(string $uri, array|string|callable|null $action = null, string $name)
    {
        $routeName = SupportLadminRoute::routeName($name);
        Route::post($uri, $action)->name($routeName);
        Ladmin::addRoute($uri);
        Ladmin::addRouteName($routeName);
    }

    public function put(string $uri, array|string|callable|null $action = null, string $name)
    {
        $routeName = SupportLadminRoute::routeName($name);
        Route::put($uri, $action)->name($routeName);
        Ladmin::addRoute($uri);
        Ladmin::addRouteName($routeName);
    }

    public function patch(string $uri, array|string|callable|null $action = null, string $name)
    {
        $routeName = SupportLadminRoute::routeName($name);
        Route::patch($uri, $action)->name($routeName);
        Ladmin::addRoute($uri);
        Ladmin::addRouteName($routeName);
    }

    public function delete(string $uri, array|string|callable|null $action = null, string $name)
    {
        $routeName = SupportLadminRoute::routeName($name);
        Route::delete($uri, $action)->name($routeName);
        Ladmin::addRoute($uri);
        Ladmin::addRouteName($routeName);
    }

    public function dashboard(?array $action = null)
    {
        if (!$action) {
            $action = [DashboardController::class, 'index'];
        }
        $this->get(SupportLadminRoute::route(config('ladmin.route.dashboard')), $action, config('ladmin.route.dashboard'));
    }

    public function crud(string $modelClassOrTableName)
    {
        $this->detail($modelClassOrTableName);
        $showCrud = $this->show($modelClassOrTableName);
        return $showCrud;
    }

    public function show(string $modelClassOrTableName)
    {
        $instance = $this->createInstance($modelClassOrTableName);
        $crud = new Crud();
        if ($instance instanceof Model) {
            $crud->model($instance)->show();
        } else if ($instance instanceof Builder) {
            $crud->table($instance, $modelClassOrTableName)->show();
        }
        Route::get($crud->getRoute(), function (Request $request) use ($crud) {
            return $crud->getController()->show($request);
        })->name($crud->getRouteName());
        $crud->addNavigation('navigation');
        Ladmin::addRoute($crud->getRoute());
        Ladmin::addRouteName($crud->getRouteName());
        Ladmin::crudRegister($crud);
        return $crud;
    }

    public function detail(string $modelClassOrTableName)
    {
        $instance = $this->createInstance($modelClassOrTableName);
        $crud = new Crud();
        if ($instance instanceof Model) {
            $crud->model($instance)->detail();
        }
        if ($instance instanceof Builder) {
            $crud->table($instance, $modelClassOrTableName)->detail();
        }
        Route::get($crud->getRoute(), function (Request $request) use ($crud) {
            return $crud->getController()->detail($request);
        })->name($crud->getRouteName());
        Ladmin::addRoute($crud->getRoute());
        Ladmin::addRouteName($crud->getRouteName());
        Ladmin::crudRegister($crud);
        return $crud;
    }

    protected function createInstance(string $modelClassOrTableName)
    {
        if (class_exists($modelClassOrTableName) && is_subclass_of($modelClassOrTableName, 'Illuminate\Database\Eloquent\Model')) {
            return app()->make($modelClassOrTableName);
        } else {
            return DB::table($modelClassOrTableName);
        }
    }
}
