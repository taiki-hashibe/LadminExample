<?php

namespace LowB\Ladmin\Route;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use LowB\Ladmin\Crud\Crud;
use LowB\Ladmin\Facades\Ladmin;

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
            throw new \Exception("The variable '$modelClassOrTableName' must be either a model class name or a table name.");
        }
        Route::middleware(config('ladmin.auth.middleware'))->{$routingMethod}($crud->route(), function (Request $request) use ($crud, $crudMethod) {
            return $crud->controller()->{$crudMethod}($request);
        })->name($crud->routeName());
        Ladmin::crudRegister($crud);
        return $crud;
    }
}
