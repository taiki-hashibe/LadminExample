<?php

namespace LowB\Ladmin\Crud;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Schema;
use LowB\Ladmin\Controllers\AbstractCrudController;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use LowB\Ladmin\Facades\Ladmin;
use LowB\Ladmin\Support\Facades\LadminRoute as FacadesLadminRoute;

class Crud
{
    protected Model|Builder|null $query = null;
    protected string $label = '';
    protected string $route = 'default';
    protected string $routeName = 'default';
    protected string $queryBaseName = 'default';
    protected string $tableName = 'default';
    protected string $primaryKey = 'id';
    protected array $columns = [];
    protected array $columnNames = [];
    protected array $config = [];
    protected array $navigation = [];
    protected AbstractCrudController $controller;

    protected function init()
    {
        $columns = Schema::connection(config('database.default'))->getColumnListing($this->tableName);
        $this->columnNames = $columns;
        $columnDetails = [];
        foreach ($columns as $column) {
            $columnDetails[$column] = Schema::connection(config('database.default'))->getConnection()->getDoctrineColumn($this->tableName, $column);
        }
        $this->columns = $columnDetails;
        $this->label = $this->tableName;
        $this->controller = $this->createController();
        $this->controller->init($this);
    }

    public function model(Model $model, array $config = []): self
    {
        $this->query = $model;
        $this->queryBaseName = class_basename(get_class($this->query));
        $this->primaryKey = $this->query->getKeyName();
        $this->tableName = $this->query->getTable();
        $this->config = $config;
        $this->init();
        return $this;
    }

    public function table(Builder $builder, string $tableName, array $config = []): self
    {
        $this->query = $builder;
        $this->queryBaseName = Str::studly($tableName);
        $this->tableName = $tableName;
        $this->config = $config;
        $this->init();
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

    public function getQuery()
    {
        return $this->query;
    }

    public function setPrimaryKey(string $primaryKey)
    {
        return $this->primaryKey = $primaryKey;
    }

    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }

    public function getColumnNames()
    {
        return $this->columnNames;
    }

    public function getColumns()
    {
        return $this->columns;
    }

    public function getTableName(): string
    {
        return $this->tableName;
    }

    public function setLabel(string $label)
    {
        return $this->label = $label;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setNavigation(array $navigation)
    {
        $this->navigation = $navigation;
    }

    public function addNavigation(string $navigation)
    {
        $this->navigation[] = $navigation;
    }

    public function removeNavigation(string $navigation)
    {
        if (($key = array_search($navigation, $this->navigation)) !== false) {
            unset($this->navigation[$key]);
        }
        $this->navigation = array_values($this->navigation);
    }

    public function getNavigation()
    {
        return $this->navigation;
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
        $controllerClassName = config('ladmin.path.controller') . '\\' . $this->queryBaseName . 'Controller';
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
        return FacadesLadminRoute::route($this->tableName, config('ladmin.route.show'));
    }

    public function getShowRouteName(): string
    {
        return FacadesLadminRoute::routeName($this->tableName, config('ladmin.route.show'));
    }

    public function getDetailRoute(): string
    {
        return FacadesLadminRoute::route($this->tableName, config('ladmin.route.detail'), true);
    }

    public function getDetailRouteName(): string
    {
        return FacadesLadminRoute::routeName($this->tableName, config('ladmin.route.detail'));
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

    public function isDetailable()
    {
        return in_array($this->getDetailRouteName(), Ladmin::getRouteNames());
    }

    public function isEditable()
    {
        return in_array($this->getEditorRouteName(), Ladmin::getRouteNames());
    }

    public function isCreatable()
    {
        return in_array($this->getCreateRouteName(), Ladmin::getRouteNames());
    }

    public function isUpdatable()
    {
        return in_array($this->getUpdateRouteName(), Ladmin::getRouteNames());
    }

    public function isDeletable()
    {
        return in_array($this->getDestroyRouteName(), Ladmin::getRouteNames());
    }

    public function isActive()
    {
        return FacadesLadminRoute::isCurrentTable($this->tableName);
    }
}
