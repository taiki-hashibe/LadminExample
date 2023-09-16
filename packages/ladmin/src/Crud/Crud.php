<?php

namespace LowB\Ladmin\Crud;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

class Crud
{
    protected string $route = 'default';
    protected array $routes = [];
    protected Model|null $model = null;
    protected string $tableName = 'default';
    protected array $columns = [];

    public function model(Model $model, array $config = [])
    {
        $this->model = $model;
        $this->tableName = $this->model->getTable();
        $columns = Schema::connection(config('database.default'))->getColumnListing($this->tableName);
        $columnDetails = [];
        foreach ($columns as $column) {
            $columnDetails[$column] = Schema::connection(config('database.default'))->getConnection()->getDoctrineColumn($this->tableName, $column);
        }
        $this->columns = $columnDetails;

        $this->routes = [
            Route::get($this->tableName . '/show', function () {
                dump($this->tableName . 'show');
            }),
            Route::get($this->tableName . '/detail', function () {
                dump($this->tableName . 'detail');
            }),
            Route::get($this->tableName . '/editor', function () {
                dump($this->tableName . 'editor');
            }),
            Route::get($this->tableName . '/create', function () {
                dump($this->tableName . 'create');
            }),
        ];

        return $this;
    }

    public function getRoutes()
    {
        return $this->routes;
    }
}
