<?php

namespace LowB\Ladmin\Support;

use Closure;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use LowB\Ladmin\Crud\Facades\Crud;

class LadminRoute
{
    public array $routes = [];

    public function route()
    {
        return Route::prefix(config('ladmin.route.prefix'))->group($this->routes);
    }

    public function add(array|Closure|null $routes = null)
    {
        if ($routes) {
            $routes = Arr::wrap($routes);
            foreach ($routes as $route) {
                array_push($this->routes, $route);
            }
            return;
        }
    }

    public function crud(string $modelClassOrTableName)
    {
        $model = $this->isModelClass($modelClassOrTableName);
        if ($model) {
            return Crud::model($model);
        };
    }

    public function isModelClass(string $modelClass): bool|Model
    {
        if (!class_exists($modelClass)) {
            return false;;
        }
        $model = app()->make($modelClass);
        if (!$model instanceof Model) {
            return false;
        }
        return $model;
    }

    public function isTableName(string $tableName): bool|Builder
    {
        $table = DB::table($tableName);
        if (!$table) {
            return false;
        }
        return $table;
    }
}
