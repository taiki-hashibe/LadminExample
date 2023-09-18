<?php

namespace LowB\Ladmin\Route;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use LowB\Ladmin\Crud\Crud;
use LowB\Ladmin\Facades\Ladmin;
use LowB\Ladmin\Support\Facades\LadminRoute;

trait CrudRoute
{

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
        return $this->crudMethods('editor', 'get', $modelClassOrTableName, '{primaryKey?}');
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

    private function crudMethods(string $crudMethod, string $routingMethod, string $modelClassOrTableName, string|bool $primaryKey = false): Crud
    {
        $instance = $this->createInstance($modelClassOrTableName);
        $crud = null;
        $route = null;
        $routeName = null;
        if ($instance instanceof Model) {
            $route = LadminRoute::route($instance->getTable(), config('ladmin.route.' . $crudMethod), $primaryKey);
            $routeName = LadminRoute::routeName($instance->getTable(), config('ladmin.route.' . $crudMethod));
            $crud = new Crud($crudMethod, $instance->getTable(), $route, $routeName);
            $crud->model($instance)->{$crudMethod}();
        } else if ($instance instanceof Builder) {
            $route = LadminRoute::route($modelClassOrTableName, config('ladmin.route.' . $crudMethod), $primaryKey);
            $routeName = LadminRoute::routeName($modelClassOrTableName, config('ladmin.route.' . $crudMethod));
            $crud = new Crud($crudMethod, $modelClassOrTableName, $route, $routeName);
            $crud->table($instance, $modelClassOrTableName)->{$crudMethod}();
        }
        Route::middleware(config('ladmin.auth.middleware'))->{$routingMethod}($crud->route(), function (Request $request) use ($crud, $crudMethod) {
            return $crud->controller()->{$crudMethod}($request);
        })->name($crud->routeName());
        Ladmin::crudRegister($crud);
        return $crud;
    }
}
