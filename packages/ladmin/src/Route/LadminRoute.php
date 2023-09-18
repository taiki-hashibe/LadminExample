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
        $uri = SupportLadminRoute::route($uri);
        $routeName = SupportLadminRoute::routeName($name);
        $router = Route::get($uri, $action)->name($routeName);
        $crud = new Crud();
        $crud->router($router, $name);
        Ladmin::crudRegister($crud);
        return $router;
    }

    public function post(string $uri, array|string|callable|null $action = null, string $name): \Illuminate\Routing\Route
    {
        $uri = SupportLadminRoute::route($uri);
        $routeName = SupportLadminRoute::routeName($name);
        $router = Route::post($uri, $action)->name($routeName);
        $crud = new Crud();
        $crud->router($router, $name);
        Ladmin::crudRegister($crud);
        return $router;
    }

    public function put(string $uri, array|string|callable|null $action = null, string $name): \Illuminate\Routing\Route
    {
        $uri = SupportLadminRoute::route($uri);
        $routeName = SupportLadminRoute::routeName($name);
        $router = Route::put($uri, $action)->name($routeName);
        $crud = new Crud();
        $crud->router($router, $name);
        Ladmin::crudRegister($crud);
        return $router;
    }

    public function patch(string $uri, array|string|callable|null $action = null, string $name): \Illuminate\Routing\Route
    {
        $uri = SupportLadminRoute::route($uri);
        $routeName = SupportLadminRoute::routeName($name);
        $router = Route::patch($uri, $action)->name($routeName);
        $crud = new Crud();
        $crud->router($router, $name);
        Ladmin::crudRegister($crud);
        return $router;
    }

    public function delete(string $uri, array|string|callable|null $action = null, string $name): \Illuminate\Routing\Route
    {
        $uri = SupportLadminRoute::route($uri);
        $routeName = SupportLadminRoute::routeName($name);
        $router = Route::delete($uri, $action)->name($routeName);
        $crud = new Crud();
        $crud->router($router, $name);
        Ladmin::crudRegister($crud);
        return $router;
    }

    public function match(array|string $methods, string $uri, array|string|callable|null $action = null, string $name): \Illuminate\Routing\Route
    {
        $uri = SupportLadminRoute::route($uri);
        $routeName = SupportLadminRoute::routeName($name);
        $router = Route::match($methods, $uri, $action)->name($routeName);
        $crud = new Crud();
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
        $instance = $this->createInstance($modelClassOrTableName);
        $crud = new Crud();
        if ($instance instanceof Model) {
            $crud->model($instance)->show();
        } else if ($instance instanceof Builder) {
            $crud->table($instance, $modelClassOrTableName)->show();
        }
        Route::middleware(config('ladmin.auth.middleware'))->get($crud->route(), function (Request $request) use ($crud) {
            return $crud->controller()->show($request);
        })->name($crud->routeName());
        $crud->navigation('navigation');
        Ladmin::crudRegister($crud);
        return $crud;
    }

    public function detail(string $modelClassOrTableName): Crud
    {
        $instance = $this->createInstance($modelClassOrTableName);
        $crud = new Crud();
        if ($instance instanceof Model) {
            $crud->model($instance)->detail();
        }
        if ($instance instanceof Builder) {
            $crud->table($instance, $modelClassOrTableName)->detail();
        }
        Route::middleware(config('ladmin.auth.middleware'))->get($crud->route(), function (Request $request) use ($crud) {
            return $crud->controller()->detail($request);
        })->name($crud->routeName());
        Ladmin::crudRegister($crud);
        return $crud;
    }

    public function editor(string $modelClassOrTableName): Crud
    {
        $instance = $this->createInstance($modelClassOrTableName);
        $crud = new Crud();
        if ($instance instanceof Model) {
            $crud->model($instance)->editor();
        }
        if ($instance instanceof Builder) {
            $crud->table($instance, $modelClassOrTableName)->editor();
        }
        Route::middleware(config('ladmin.auth.middleware'))->get($crud->route(), function (Request $request) use ($crud) {
            return $crud->controller()->editor($request);
        })->name($crud->routeName());
        Ladmin::crudRegister($crud);
        return $crud;
    }

    public function create(string $modelClassOrTableName): Crud
    {
        $instance = $this->createInstance($modelClassOrTableName);
        $crud = new Crud();
        if ($instance instanceof Model) {
            $crud->model($instance)->create();
        }
        if ($instance instanceof Builder) {
            $crud->table($instance, $modelClassOrTableName)->create();
        }
        Route::middleware(config('ladmin.auth.middleware'))->post($crud->route(), function (Request $request) use ($crud) {
            return $crud->controller()->create($request);
        })->name($crud->routeName());
        Ladmin::crudRegister($crud);
        return $crud;
    }

    public function update(string $modelClassOrTableName): Crud
    {
        $instance = $this->createInstance($modelClassOrTableName);
        $crud = new Crud();
        if ($instance instanceof Model) {
            $crud->model($instance)->update();
        }
        if ($instance instanceof Builder) {
            $crud->table($instance, $modelClassOrTableName)->update();
        }
        Route::middleware(config('ladmin.auth.middleware'))->post($crud->route(), function (Request $request) use ($crud) {
            return $crud->controller()->update($request);
        })->name($crud->routeName());
        Ladmin::crudRegister($crud);
        return $crud;
    }

    public function destroy(string $modelClassOrTableName): Crud
    {
        $instance = $this->createInstance($modelClassOrTableName);
        $crud = new Crud();
        if ($instance instanceof Model) {
            $crud->model($instance)->destroy();
        }
        if ($instance instanceof Builder) {
            $crud->table($instance, $modelClassOrTableName)->destroy();
        }
        Route::middleware(config('ladmin.auth.middleware'))->post($crud->route(), function (Request $request) use ($crud) {
            return $crud->controller()->destroy($request);
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
