<?php

namespace LowB\Ladmin\Crud;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use LowB\Ladmin\Controllers\AbstractCrudController;
use Illuminate\Support\Arr;
use LowB\Ladmin\Support\Facades\LadminRoute;

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

    protected function show(): self
    {
        $this->route = $this->getShowRoute();
        $this->routeName = $this->getShowRouteName();
        return $this;
    }

    protected function detail(): self
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

    public function getEditorRoute(): string
    {
        return '/' . Arr::join([config('ladmin.route.prefix'), $this->tableName, config('ladmin.route.editor')], '/') . '/{id?}';
    }

    public function getEditorRouteName(): string
    {
        return Arr::join([config('ladmin.route.prefix'), $this->tableName, config('ladmin.route.editor')], '.');
    }


    public function getCreateRoute(): string
    {
        return '/' . Arr::join([config('ladmin.route.prefix'), $this->tableName, config('ladmin.route.create')], '/');
    }

    public function getCreateRouteName(): string
    {
        return Arr::join([config('ladmin.route.prefix'), $this->tableName, config('ladmin.route.create')], '.');
    }

    public function getUpdateRoute(): string
    {
        return '/' . Arr::join([config('ladmin.route.prefix'), $this->tableName, config('ladmin.route.update')], '/{id}');
    }

    public function getUpdateRouteName(): string
    {
        return Arr::join([config('ladmin.route.prefix'), $this->tableName, config('ladmin.route.update')], '.');
    }

    public function getDestroyRoute(): string
    {
        return '/' . Arr::join([config('ladmin.route.prefix'), $this->tableName, config('ladmin.route.destroy')], '/{id}');
    }

    public function getDestroyRouteName(): string
    {
        return Arr::join([config('ladmin.route.prefix'), $this->tableName, config('ladmin.route.destroy')], '.');
    }

    public function getTableName(): string
    {
        return $this->tableName;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function isDetailable()
    {
        return in_array($this->getDetailRouteName(), LadminRoute::getRoutes());
    }

    public function isEditable()
    {
        return in_array($this->getEditorRouteName(), LadminRoute::getRoutes());
    }

    public function isCreatable()
    {
        return in_array($this->getCreateRouteName(), LadminRoute::getRoutes());
    }

    public function isUpdatable()
    {
        return in_array($this->getUpdateRouteName(), LadminRoute::getRoutes());
    }

    public function isDeletable()
    {
        return in_array($this->getDestroyRouteName(), LadminRoute::getRoutes());
    }
}
