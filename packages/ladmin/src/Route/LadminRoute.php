<?php

namespace LowB\Ladmin\Route;

use Illuminate\Contracts\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use LowB\Ladmin\Controllers\AuthController;
use LowB\Ladmin\Controllers\DashboardController;
use LowB\Ladmin\Controllers\ProfileController;
use LowB\Ladmin\Crud\Crud;
use LowB\Ladmin\Facades\Ladmin;
use LowB\Ladmin\Support\Facades\LadminRoute as SupportLadminRoute;

class LadminRoute
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
        $uri = SupportLadminRoute::route($uri);
        $routeName = SupportLadminRoute::routeName($name);
        $router = Route::match($methods, $uri, $action)->name($routeName);
        $crud = new Crud($name);
        $crud->router($router, $name);
        Ladmin::crudRegister($crud);
        return $router;
    }

    protected function routing(string $method, string $uri, array|string|callable|null $action = null, string $name): \Illuminate\Routing\Route
    {
        $uri = SupportLadminRoute::route($uri);
        $routeName = SupportLadminRoute::routeName($name);
        $router = Route::{$method}($uri, $action)->name($routeName);
        $crud = new Crud($name);
        $crud->router($router, $name);
        Ladmin::crudRegister($crud);
        return $router;
    }

    public function auth(): void
    {
        $this->post(config('ladmin.auth.logout.url'), [AuthController::class, 'logout'], config('ladmin.auth.logout.name'))->middleware(config('ladmin.auth.middleware'));
        $this->match(['GET', 'POST'], config('ladmin.auth.login.name'), [AuthController::class, 'login'], config('ladmin.auth.login.name'));
    }

    public function dashboard(): void
    {
        $this->get(config('ladmin.dashboard.show.url'), [DashboardController::class, 'show'], config('ladmin.dashboard.show.name'))->middleware(config('ladmin.auth.middleware'));
    }

    public function profile(): void
    {
        $this->get(config('ladmin.profile.show.url'), [ProfileController::class, 'show'], config('ladmin.profile.show.name'))->middleware(config('ladmin.auth.middleware'));
        $this->post(config('ladmin.profile.update.url'), [ProfileController::class, 'update'], config('ladmin.profile.update.name'))->middleware(config('ladmin.auth.middleware'));
        $this->post(config('ladmin.profile.destroy.url'), [ProfileController::class, 'destroy'], config('ladmin.profile.destroy.name'))->middleware(config('ladmin.auth.middleware'));
    }

    public function crud(string $modelClassOrTableName): Crud
    {
        $this->detail($modelClassOrTableName);
        $this->editor($modelClassOrTableName);
        $this->create($modelClassOrTableName);
        $this->update($modelClassOrTableName);
        $this->destroy($modelClassOrTableName);
        $showCrud = $this->show($modelClassOrTableName);
        return $showCrud;
    }

    public function show(string $modelClassOrTableName): Crud
    {
        return $this->crudMethods('show', 'get', $modelClassOrTableName)->navigation('navigation');
    }

    public function detail(string $modelClassOrTableName): Crud
    {
        return $this->crudMethods('detail', 'get', $modelClassOrTableName);
    }

    public function editor(string $modelClassOrTableName): Crud
    {
        return $this->crudMethods('editor', 'get', $modelClassOrTableName);
    }

    public function create(string $modelClassOrTableName): Crud
    {
        return $this->crudMethods('create', 'post', $modelClassOrTableName);
    }

    public function update(string $modelClassOrTableName): Crud
    {
        return $this->crudMethods('update', 'post', $modelClassOrTableName);
    }

    public function destroy(string $modelClassOrTableName): Crud
    {
        return $this->crudMethods('destroy', 'post', $modelClassOrTableName);
    }

    private function crudMethods(string $crudMethod, string $routingMethod, string $modelClassOrTableName): Crud
    {
        $instance = $this->createInstance($modelClassOrTableName);
        $crud = null;
        if ($instance instanceof Model) {
            $crud = new Crud($instance->getTable());
            $crud->model($instance)->{$crudMethod}();
        } else if ($instance instanceof Builder) {
            $crud = new Crud($modelClassOrTableName);
            $crud->table($instance, $modelClassOrTableName)->{$crudMethod}();
        }
        if (!$crud) {
            throw new \Exception("The variable 'modelClassOrTableName' must be either a model class name or a table name.");
        }
        Route::middleware(config('ladmin.auth.middleware'))->{$routingMethod}($crud->route(), function (Request $request) use ($crud, $crudMethod) {
            return $crud->controller()->{$crudMethod}($request);
        })->name($crud->routeName());
        Ladmin::crudRegister($crud);
        return $crud;
    }

    protected function createInstance(string $modelClassOrTableName): Model | QueryBuilder
    {
        if (class_exists($modelClassOrTableName) && is_subclass_of($modelClassOrTableName, 'Illuminate\Database\Eloquent\Model')) {
            return app()->make($modelClassOrTableName);
        } else {
            return DB::table($modelClassOrTableName);
        }
    }
}
