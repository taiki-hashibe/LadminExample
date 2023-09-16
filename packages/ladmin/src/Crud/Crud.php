<?php

namespace LowB\Ladmin\Crud;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use LowB\Ladmin\Controllers\AbstractCrudController;
use Illuminate\Support\Arr;

class Crud
{
    protected string $route = 'default';
    protected Model|null $model = null;
    protected string $modelClassBaseName = 'default';
    protected string $tableName = 'default';
    protected array $columnNames = [];
    protected array $columns = [];
    protected string $label = '';
    protected array $config = [];
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
        $this->label = $this->tableName;
        $this->config = $config;
        $this->controller = $this->getController();
        $this->controller->init($this);
        return $this;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getColumnNames()
    {
        return $this->columnNames;
    }

    public function getColumns()
    {
        return $this->columns;
    }

    public function show(): self
    {
        $this->route = '/' . Arr::join([$this->tableName, config('ladmin.route.show')], '/');
        Route::get($this->route, function (Request $request) {
            return $this->controller->show($request);
        })->name(Arr::join([config('ladmin.route.prefix'), $this->tableName, config('ladmin.route.show')], '.'));
        return $this;
    }

    public function detail(): self
    {
        $this->route = '/' . Arr::join([$this->tableName, config('ladmin.route.detail')], '/') . '{id}';
        Route::get($this->route, function (Request $request) {
            return $this->controller->detail($request);
        });
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

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getRoute(): string
    {
        return $this->route;
    }
}
