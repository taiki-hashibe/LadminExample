<?php

namespace LowB\Ladmin\Route;

use Exception;
use LowB\Ladmin\Controllers\CrudController;
use LowB\Ladmin\Route\Facades\Route;
use LowB\Ladmin\Support\Query\LadminQuery;

class LadminRoute
{
    private array $routes;

    public function __call($method, $args)
    {
        $router = Route::prefix(config('ladmin.route.prefix'))->{$method}(...$args);
        $this->routes[] = $router;
        return $router;
    }

    private function _crudRouting(LadminQuery $query, CrudController $controller, string $method, string $actionName): mixed
    {
        $router = Route::prefix(config('ladmin.route.prefix'))->{$method}($query->getTable() . '/' . $actionName, [$controller::class, $actionName]);
        $this->routes[] = $router;
        return $router;
    }

    private function _show(LadminQuery $query, CrudController $controller): mixed
    {
        return $this->_crudRouting($query,  $controller, 'get', 'show');
    }

    private function _detail(LadminQuery $query, CrudController $controller): mixed
    {
        return $this->_crudRouting($query,  $controller, 'get', 'detail');
    }

    private function _edit(LadminQuery $query, CrudController $controller): mixed
    {
        return $this->_crudRouting($query,  $controller, 'get', 'edit');
    }

    private function _create(LadminQuery $query, CrudController $controller): mixed
    {
        return $this->_crudRouting($query,  $controller, 'post', 'create');
    }

    private function _update(LadminQuery $query, CrudController $controller): mixed
    {
        return $this->_crudRouting($query,  $controller, 'post', 'update');
    }

    private function _destroy(LadminQuery $query, CrudController $controller): mixed
    {
        return $this->_crudRouting($query,  $controller, 'post', 'destroy');
    }

    public function show(string $modelOrTable, string $controllerName = CrudController::class): mixed
    {
        return $this->_show(LadminQuery::make($modelOrTable), $this->makeController($controllerName));
    }

    public function detail(string $modelOrTable, string $controllerName = CrudController::class): mixed
    {
        return $this->_detail(LadminQuery::make($modelOrTable), $this->makeController($controllerName));
    }

    public function edit(string $modelOrTable, string $controllerName = CrudController::class): mixed
    {
        return $this->_edit(LadminQuery::make($modelOrTable), $this->makeController($controllerName));
    }

    public function create(string $modelOrTable, string $controllerName = CrudController::class): mixed
    {
        return $this->_create(LadminQuery::make($modelOrTable), $this->makeController($controllerName));
    }

    public function update(string $modelOrTable, string $controllerName = CrudController::class): mixed
    {
        return $this->_update(LadminQuery::make($modelOrTable), $this->makeController($controllerName));
    }

    public function destroy(string $modelOrTable, string $controllerName = CrudController::class): mixed
    {
        return $this->_destroy(LadminQuery::make($modelOrTable), $this->makeController($controllerName));
    }

    public function crud(string $modelOrTable, string $controllerName = CrudController::class): mixed
    {
        $query = LadminQuery::make($modelOrTable);
        $controller = $this->makeController($controllerName);
        $this->_detail($query, $controller);
        $this->_edit($query, $controller);
        $this->_create($query, $controller);
        $this->_update($query, $controller);
        $this->_destroy($query, $controller);

        return $this->_show($query, $controller);
    }

    private function makeController(string $name): CrudController
    {
        if (!class_exists($name)) {
            throw new Exception("Target class [$name] does not exist.");
        }
        return app()->make($name);
    }
}
