<?php

namespace LowB\Ladmin\Route;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use LowB\Ladmin\Crud\Crud;
use LowB\Ladmin\Facades\Ladmin;

class LadminRoute
{

    public function crud(string $modelClassOrTableName)
    {
        $this->detail($modelClassOrTableName);
        $showCrud = $this->show($modelClassOrTableName);
        return $showCrud;
    }

    protected function createInstance(string $modelClassOrTableName)
    {
        if (class_exists($modelClassOrTableName) && is_subclass_of($modelClassOrTableName, 'Illuminate\Database\Eloquent\Model')) {
            return app()->make($modelClassOrTableName);
        } else {
            return DB::table($modelClassOrTableName);
        }
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
}
