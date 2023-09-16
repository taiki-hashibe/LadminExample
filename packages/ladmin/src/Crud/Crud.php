<?php

namespace LowB\Ladmin\Crud;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use LowB\Ladmin\Contracts\Crud\CrudInterface;
use LowB\Ladmin\Controllers\AbstractCrudController;

class Crud implements CrudInterface
{
    protected string $route = 'default';
    protected array $routes = [];
    protected Model|null $model = null;
    protected string $modelClassBaseName = 'default';
    protected string $tableName = 'default';
    protected array $columns = [];
    protected AbstractCrudController $controller;

    public function model(Model $model, array $config = []): self
    {
        $this->model = $model;
        $this->modelClassBaseName = class_basename(get_class($model));
        $this->tableName = $this->model->getTable();
        $columns = Schema::connection(config('database.default'))->getColumnListing($this->tableName);
        $columnDetails = [];
        foreach ($columns as $column) {
            $columnDetails[$column] = Schema::connection(config('database.default'))->getConnection()->getDoctrineColumn($this->tableName, $column);
        }
        $this->columns = $columnDetails;
        $this->controller = $this->getController();
        $this->crud();

        return $this;
    }

    public function crud(): self
    {
        $this->show();
        $this->detail();
        return $this;
    }

    public function show(): self
    {
        array_push($this->routes, Route::get($this->tableName . '/show', function (Request $request) {
            return $this->controller->show($request);
        }));
        return $this;
    }

    public function detail(): self
    {
        array_push($this->routes, Route::get($this->tableName . '/detail', function (Request $request) {
            return $this->controller->detail($request);
        }));
        return $this;
    }

    public function getController(): AbstractCrudController
    {
        $controllerClassName = config('ladmin.path.controller') . '\\' . $this->modelClassBaseName . 'Controller';
        if (!class_exists($controllerClassName)) {
            return app()->make(AbstractCrudController::class);
        }
        $controller = app()->make($controllerClassName);
        if (!$controller instanceof AbstractCrudController) {
            return app()->make(AbstractCrudController::class);
        }
        return $controller;
    }

    public function getRoutes()
    {
        return $this->routes;
    }
}
