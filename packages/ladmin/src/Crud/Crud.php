<?php

namespace LowB\Ladmin\Crud;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Schema;
use LowB\Ladmin\Controllers\CrudController;
use Illuminate\Support\Str;
use LowB\Ladmin\Config\Facades\LadminConfig;
use LowB\Ladmin\Facades\Ladmin;
use LowB\Ladmin\Support\Facades\LadminRoute as FacadesLadminRoute;

class Crud
{
    protected string $name;
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
    protected CrudController $controller;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    protected function init(): self
    {
        $columns = Schema::connection(config('database.default'))->getColumnListing($this->tableName);
        $this->columnNames = $columns;
        $columnDetails = [];
        foreach ($columns as $column) {
            $columnDetails[$column] = Schema::connection(config('database.default'))->getConnection()->getDoctrineColumn($this->tableName, $column);
        }
        $this->columns = $columnDetails;
        $this->label = $this->tableName;
        $this->controller = $this->createCrudController();
        $this->controller->init($this);
        return $this;
    }

    public function model(Model $model, array $config = []): self
    {
        $this->query = $model;
        $this->queryBaseName = class_basename(get_class($this->query));
        $this->primaryKey = $this->query->getKeyName();
        $this->tableName = $this->query->getTable();
        $this->name = $this->query->getTable();
        $this->config = $config;
        $this->init();
        return $this;
    }

    public function table(Builder $builder, string $tableName, array $config = []): self
    {
        $this->query = $builder;
        $this->queryBaseName = Str::studly($tableName);
        $this->tableName = $tableName;
        $this->name = $tableName;
        $this->config = $config;
        $this->init();
        return $this;
    }

    public function router(\Illuminate\Routing\Route $router, string $name): self
    {
        $this->name = $name;
        $this->route = '/' . $router->uri;
        $this->routeName = $router->action['as'];
        return $this;
    }

    public function route(?string $route = null): string
    {
        if ($route) {
            $this->route = $route;
        }
        return $this->route;
    }

    public function name(?string $name = null): string
    {
        if ($name) {
            $this->name = $name;
        }
        return $this->name;
    }

    public function routeName(?string $routeName = null): string
    {
        if ($routeName) {
            $this->routeName = $routeName;
        }
        return $this->routeName;
    }

    public function query(): Model|Builder|null
    {
        return $this->query;
    }

    public function primaryKey(?string $primaryKey = null): string
    {
        if ($primaryKey) {
            $this->primaryKey = $primaryKey;
        }
        return $this->primaryKey;
    }

    public function columnNames(): array
    {
        return $this->columnNames;
    }

    public function columnNamesForShow(): array
    {
        return array_diff($this->columnNames, LadminConfig::hiddenShow());
    }

    public function columnNamesForDetail(): array
    {
        return array_diff($this->columnNames, LadminConfig::hiddenDetail());
    }

    public function columnNamesForEditor(): array
    {
        return array_diff($this->columnNames, LadminConfig::hiddenEditor());
    }

    public function columns(): array
    {
        return $this->columns;
    }

    public function tableName(?string $tableName = null): string
    {
        if ($tableName) {
            $this->tableName = $tableName;
        }
        return $this->tableName;
    }

    public function label(?string $label = null): string
    {
        if ($label) {
            $this->label = $label;
        }
        return $this->label;
    }

    public function removeNavigation(string $navigation): void
    {
        if (($key = array_search($navigation, $this->navigation)) !== false) {
            unset($this->navigation[$key]);
        }
        $this->navigation = array_values($this->navigation);
    }

    public function navigation(string|array|null $navigation = null): array|self
    {
        if (is_array($navigation)) {
            $this->navigation = $navigation;
            return $this;
        } elseif ($navigation) {
            $this->navigation[] = $navigation;
            return $this;
        }
        return $this->navigation;
    }

    public function show(): self
    {
        $this->route = $this->showRoute();
        $this->routeName = $this->showRouteName();
        return $this;
    }

    public function detail(): self
    {
        $this->route = $this->detailRoute();
        $this->routeName = $this->detailRouteName();
        return $this;
    }

    public function editor(): self
    {
        $this->route = $this->editorRoute();
        $this->routeName = $this->editorRouteName();
        return $this;
    }

    public function create(): self
    {
        $this->route = $this->createRoute();
        $this->routeName = $this->createRouteName();
        return $this;
    }

    public function update(): self
    {
        $this->route = $this->updateRoute();
        $this->routeName = $this->updateRouteName();
        return $this;
    }

    public function destroy(): self
    {
        $this->route = $this->destroyRoute();
        $this->routeName = $this->destroyRouteName();
        return $this;
    }

    protected function createCrudController(): CrudController
    {
        $controllerClassName = config('ladmin.path.controller') . '\\' . $this->queryBaseName . 'CrudController';
        if (!class_exists($controllerClassName)) {
            return app()->make(CrudController::class);
        }
        $controller = app()->make($controllerClassName);
        if (!$controller instanceof CrudController) {
            return app()->make(CrudController::class);
        }
        return $controller;
    }

    public function controller(): CrudController
    {
        return $this->controller;
    }

    public function showRoute(): string
    {
        return FacadesLadminRoute::route($this->tableName, config('ladmin.route.show'), false);
    }

    public function showRouteName(): string
    {
        return FacadesLadminRoute::routeName($this->tableName, config('ladmin.route.show'));
    }

    public function detailRoute(): string
    {
        return FacadesLadminRoute::route($this->tableName, config('ladmin.route.detail'), true);
    }

    public function detailRouteName(): string
    {
        return FacadesLadminRoute::routeName($this->tableName, config('ladmin.route.detail'));
    }

    public function editorRoute(): string
    {
        return FacadesLadminRoute::route($this->tableName, config('ladmin.route.editor'), '{primaryKey?}');
    }

    public function editorRouteName(): string
    {
        return FacadesLadminRoute::routeName($this->tableName, config('ladmin.route.editor'));
    }


    public function createRoute(): string
    {
        return FacadesLadminRoute::route($this->tableName, config('ladmin.route.create'), false);
    }

    public function createRouteName(): string
    {
        return FacadesLadminRoute::routeName($this->tableName, config('ladmin.route.create'));
    }

    public function updateRoute(): string
    {
        return FacadesLadminRoute::route($this->tableName, config('ladmin.route.update'));
    }

    public function updateRouteName(): string
    {
        return FacadesLadminRoute::routeName($this->tableName, config('ladmin.route.update'));
    }

    public function destroyRoute(): string
    {
        return FacadesLadminRoute::route($this->tableName, config('ladmin.route.destroy'));
    }

    public function destroyRouteName(): string
    {
        return FacadesLadminRoute::routeName($this->tableName, config('ladmin.route.destroy'));
    }

    public function isDetailable(): bool
    {
        return in_array($this->detailRouteName(), Ladmin::getRouteNames());
    }

    public function isEditable(): bool
    {
        return in_array($this->editorRouteName(), Ladmin::getRouteNames());
    }

    public function isCreatable(): bool
    {
        return in_array($this->createRouteName(), Ladmin::getRouteNames());
    }

    public function isUpdatable(): bool
    {
        return in_array($this->updateRouteName(), Ladmin::getRouteNames());
    }

    public function isDeletable(): bool
    {
        return in_array($this->destroyRouteName(), Ladmin::getRouteNames());
    }

    public function isActive(): bool
    {
        return FacadesLadminRoute::isCurrentTable($this->tableName);
    }

    public function toArray(): array
    {
        return [
            'label' => $this->label,
            'route' => $this->route,
            'routeName' => $this->routeName,
            'queryBaseName' => $this->queryBaseName,
            'tableName' => $this->tableName,
            'primaryKey' => $this->primaryKey,
            'columns' => $this->columns,
            'columnNames' => $this->columnNames,
            'config' => $this->config,
            'navigation' => $this->navigation
        ];
    }
}
