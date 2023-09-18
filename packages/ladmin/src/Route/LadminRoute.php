<?php

namespace LowB\Ladmin\Route;

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

    public function match(array|string $methods, string $uri, array|string|callable|null $action = null, string $name)
    {
        $routeName = SupportLadminRoute::routeName($name);
        Route::match($methods, $uri, $action)->name($routeName);
        Ladmin::addRoute($uri);
        Ladmin::addRouteName($routeName);
    }

    public function auth()
    {
        $action = [AuthController::class, 'logout'];
        $uri = SupportLadminRoute::route(config('ladmin.route.logout'), null, false);
        $routeName = config('ladmin.route.logout');
        $crud = new Crud();
        $crud->setTableName(config('ladmin.route.logout'));
        $crud->setLabel(config('ladmin.route.logout'));
        $crud->setRoute($uri);
        $crud->setRouteName(SupportLadminRoute::routeName($routeName));
        Ladmin::addRoute($crud->getRoute());
        Ladmin::addRouteName($crud->getRouteName());
        Ladmin::crudRegister($crud);
        $this->post($uri, $action, $routeName);

        $action = [AuthController::class, 'login'];
        $uri = SupportLadminRoute::route(config('ladmin.route.login'), null, false);
        $routeName = config('ladmin.route.login');
        $crud = new Crud();
        $crud->setTableName(config('ladmin.route.login'));
        $crud->setLabel(config('ladmin.route.login'));
        $crud->setRoute($uri);
        $crud->setRouteName(SupportLadminRoute::routeName($routeName));
        Ladmin::addRoute($crud->getRoute());
        Ladmin::addRouteName($crud->getRouteName());
        Ladmin::crudRegister($crud);
        $this->match(['GET', 'POST'], $uri, $action, $routeName);
        return $crud;
    }

    public function dashboard(?array $action = null)
    {
        if (!$action) {
            $action = [DashboardController::class, 'index'];
        }
        $uri = SupportLadminRoute::route(config('ladmin.route.dashboard'), null, false);
        $routeName = config('ladmin.route.dashboard');
        $crud = new Crud();
        $crud->setTableName(config('ladmin.route.dashboard'));
        $crud->setLabel(config('ladmin.route.dashboard'));
        $crud->setRoute($uri);
        $crud->setRouteName(SupportLadminRoute::routeName($routeName));
        $crud->addNavigation('navigation');
        Ladmin::addRoute($crud->getRoute());
        Ladmin::addRouteName($crud->getRouteName());
        Ladmin::crudRegister($crud);
        $this->get($uri, $action, $routeName);
        return $crud;
    }

    public function profile(?array $action = null)
    {
        if (!$action) {
            $action = [ProfileController::class, 'index'];
        }
        $uri = SupportLadminRoute::route(config('ladmin.route.profile'), null, false);
        $routeName = config('ladmin.route.profile');
        $crud = new Crud();
        $crud->setTableName(config('ladmin.route.profile'));
        $crud->setLabel(config('ladmin.route.profile'));
        $crud->setRoute($uri);
        $crud->setRouteName(SupportLadminRoute::routeName($routeName));
        $crud->addNavigation('dropdown');
        Ladmin::addRoute($crud->getRoute());
        Ladmin::addRouteName($crud->getRouteName());
        Ladmin::crudRegister($crud);
        $this->get($uri, $action, $routeName);
        return $crud;
    }

    public function crud(string $modelClassOrTableName)
    {
        $this->detail($modelClassOrTableName);
        $this->editor($modelClassOrTableName);
        $this->create($modelClassOrTableName);
        $this->update($modelClassOrTableName);
        $this->destroy($modelClassOrTableName);
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

    public function editor(string $modelClassOrTableName)
    {
        $instance = $this->createInstance($modelClassOrTableName);
        $crud = new Crud();
        if ($instance instanceof Model) {
            $crud->model($instance)->editor();
        }
        if ($instance instanceof Builder) {
            $crud->table($instance, $modelClassOrTableName)->editor();
        }
        Route::get($crud->getRoute(), function (Request $request) use ($crud) {
            return $crud->getController()->editor($request);
        })->name($crud->getRouteName());
        Ladmin::addRoute($crud->getRoute());
        Ladmin::addRouteName($crud->getRouteName());
        Ladmin::crudRegister($crud);
        return $crud;
    }

    public function create(string $modelClassOrTableName)
    {
        $instance = $this->createInstance($modelClassOrTableName);
        $crud = new Crud();
        if ($instance instanceof Model) {
            $crud->model($instance)->create();
        }
        if ($instance instanceof Builder) {
            $crud->table($instance, $modelClassOrTableName)->create();
        }
        Route::post($crud->getRoute(), function (Request $request) use ($crud) {
            return $crud->getController()->create($request);
        })->name($crud->getRouteName());
        Ladmin::addRoute($crud->getRoute());
        Ladmin::addRouteName($crud->getRouteName());
        Ladmin::crudRegister($crud);
        return $crud;
    }

    public function update(string $modelClassOrTableName)
    {
        $instance = $this->createInstance($modelClassOrTableName);
        $crud = new Crud();
        if ($instance instanceof Model) {
            $crud->model($instance)->update();
        }
        if ($instance instanceof Builder) {
            $crud->table($instance, $modelClassOrTableName)->update();
        }
        Route::post($crud->getRoute(), function (Request $request) use ($crud) {
            return $crud->getController()->update($request);
        })->name($crud->getRouteName());
        Ladmin::addRoute($crud->getRoute());
        Ladmin::addRouteName($crud->getRouteName());
        Ladmin::crudRegister($crud);
        return $crud;
    }

    public function destroy(string $modelClassOrTableName)
    {
        $instance = $this->createInstance($modelClassOrTableName);
        $crud = new Crud();
        if ($instance instanceof Model) {
            $crud->model($instance)->destroy();
        }
        if ($instance instanceof Builder) {
            $crud->table($instance, $modelClassOrTableName)->destroy();
        }
        Route::post($crud->getRoute(), function (Request $request) use ($crud) {
            return $crud->getController()->destroy($request);
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
