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
    protected Model|null $model = null;
    protected string $label = '';
    protected string $route = 'default';
    protected string $routeName = 'default';
    protected string $modelClassBaseName = 'default';
    protected string $tableName = 'default';
    protected array $columns = [];
    protected array $columnNames = [];
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
        $this->controller = $this->createController();
        $this->controller->init($this);
        return $this;
    }

    public function getRoute()
    {
        return $this->route;
    }

    public function getRouteName()
    {
        return $this->routeName;
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
        $this->route = $this->getShowRoute();
        $this->routeName = $this->getShowRouteName();
        return $this;
    }

    public function detail(): self
    {
        $this->route = $this->getDetailRoute();
        $this->routeName = $this->getDetailRouteName();
        return $this;
    }

    protected function createController(): AbstractCrudController
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

    public function getController()
    {
        return $this->controller;
    }

    public function getShowRoute(): string
    {
        return '/' . Arr::join([config('ladmin.route.prefix'), $this->tableName, config('ladmin.route.show')], '/');
    }

    public function getShowRouteName(): string
    {
        return Arr::join([config('ladmin.route.prefix'), $this->tableName, config('ladmin.route.show')], '.');
    }

    public function getDetailRoute(): string
    {
        return '/' . Arr::join([config('ladmin.route.prefix'), $this->tableName, config('ladmin.route.detail')], '/') . '/{id}';
    }

    public function getDetailRouteName(): string
    {
        return Arr::join([config('ladmin.route.prefix'), $this->tableName, config('ladmin.route.detail')], '.');
    }

    public function getTableName(): string
    {
        return $this->tableName;
    }

    public function getLabel(): string
    {
        return $this->label;
    }
}
