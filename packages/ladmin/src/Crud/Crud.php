<?php

namespace LowB\Ladmin\Crud;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Schema;
use LowB\Ladmin\Controllers\CrudController;
use Illuminate\Support\Str;
use LowB\Ladmin\Facades\Ladmin;
use LowB\Ladmin\Support\Facades\LadminRoute as FacadesLadminRoute;

class Crud
{
    protected string $name;
    protected string $crud;
    protected string $route;
    protected string $routeName;
    protected Model|Builder|null $query = null;
    protected string|null $label = null;
    protected string|null $queryBaseName = null;
    protected string|null $tableName = null;
    protected string|null $primaryKey = null;
    protected string|null $displayKey = null;
    protected array $columns = [];
    protected array $columnNames = [];
    protected array $navigation = [];
    protected CrudController $controller;

    public function __construct(string $crud, string $name, string $route, string $routeName)
    {
        $this->crud = $crud;
        $this->name = $name;
        $this->route = $route;
        $this->routeName = $routeName;
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

    public function model(Model $model, ?string $displayKey = null): self
    {
        $this->query = $model;
        $this->queryBaseName = class_basename(get_class($this->query));
        $this->primaryKey = $this->query->getKeyName();
        $this->displayKey = $displayKey ?? $this->primaryKey;
        $this->tableName = $this->query->getTable();
        $this->init();
        return $this;
    }

    public function table(Builder $builder, string $tableName, ?string $displayKey = null): self
    {
        $this->query = $builder;
        $this->queryBaseName = Str::studly($tableName);
        $this->tableName = $tableName;
        $this->displayKey = $displayKey ?? $this->primaryKey;
        $this->init();
        return $this;
    }

    public function route(?string $route = null): string|self
    {
        if ($route) {
            $this->route = $route;
            return $this;
        }
        return $this->route;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function crud(): string
    {
        return $this->crud;
    }

    public function routeName(): string|null
    {
        return $this->routeName;
    }

    public function query(): Model|Builder|null
    {
        return $this->query;
    }

    public function primaryKey(): string|null
    {
        return $this->primaryKey;
    }

    public function columnNames(): array
    {
        return $this->columnNames;
    }

    public function columns(): array
    {
        return $this->columns;
    }

    public function tableName(): string|null
    {
        return $this->tableName;
    }

    public function label(?string $label = null): string|null
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

    private function findCrudByMethod(string $method): Crud|null
    {
        $crudList = Ladmin::crudFindByTableName($this->tableName);
        foreach ($crudList as $crud) {
            if ($crud->crud() === $method) {
                return $crud;
            }
        }
        return null;
    }

    public function show(): Crud|null
    {
        return $this->findCrudByMethod('show');
    }

    public function detail(): Crud|null
    {
        return $this->findCrudByMethod('detail');
    }

    public function editor(): Crud|null
    {
        return $this->findCrudByMethod('editor');
    }

    public function create(): Crud|null
    {
        return $this->findCrudByMethod('create');
    }

    public function update(): Crud|null
    {
        return $this->findCrudByMethod('update');
    }

    public function destroy(): Crud|null
    {
        return $this->findCrudByMethod('destroy');
    }

    public function isDetailable(): bool
    {
        return $this->detail() !== null;
    }

    public function isEditable(): bool
    {
        return $this->editor() !== null;
    }

    public function isCreatable(): bool
    {
        return $this->create() !== null;
    }

    public function isUpdatable(): bool
    {
        return $this->update() !== null;
    }

    public function isDeletable(): bool
    {
        return $this->destroy() !== null;
    }

    public function isActive(): bool
    {
        return FacadesLadminRoute::isCurrentTable($this->tableName);
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'label' => $this->label,
            'route' => $this->route,
            'routeName' => $this->routeName,
            'queryBaseName' => $this->queryBaseName,
            'tableName' => $this->tableName,
            'primaryKey' => $this->primaryKey,
            'displayKey' => $this->displayKey,
            'columns' => $this->columns,
            'columnNames' => $this->columnNames,
            'navigation' => $this->navigation
        ];
    }
}
