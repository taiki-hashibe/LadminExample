<?php

namespace LowB\Ladmin;

use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use LowB\Ladmin\Crud\Crud;

class Ladmin
{
    public array $routes = [];

    public function route(array|Closure|null $routes = null)
    {
        if ($routes) {
            $routes = Arr::wrap($routes);
            foreach ($routes as $route) {
                array_push($this->routes, $route);
            }
            return;
        }
        return Route::prefix(config('ladmin.route.prefix'))->group($this->routes);
    }

    public function crud(Crud $crud)
    {
        $this->route($crud->getRoutes());
    }

    public function model(string $modelClass, array $config = [])
    {
        if (!class_exists($modelClass)) {
            Log::error('Class "' . $modelClass . '" was not found.');
        }
        $model = app()->make($modelClass);
        $tableName = $model->getTable();
        $columns = Schema::connection(config('database.default'))->getColumnListing($tableName);
        $columnDetails = [];
        foreach ($columns as $column) {
            $columnDetails[$column] = Schema::connection(config('database.default'))->getConnection()->getDoctrineColumn($tableName, $column);
        }

        $this->route([
            Route::get($tableName, function () use ($tableName) {
                dump($tableName);
            })
        ]);
    }
}
