<?php

namespace LowB\Ladmin\Route;

use Exception;
use LowB\Ladmin\Config\Facades\LadminConfig;
use LowB\Ladmin\Controllers\CrudController;
use LowB\Ladmin\Controllers\DashboardController;
use LowB\Ladmin\Controllers\ProfileController;
use LowB\Ladmin\Route\Route;
use LowB\Ladmin\Support\Query\LadminQuery;
use Illuminate\Support\Str;

class LadminRoute
{
    private array $routes = [];

    public function getRoutes()
    {
        return $this->routes;
    }

    public function getCurrentRoute(): mixed
    {
        $currentUri = Str::of(request()->getPathInfo())->replaceFirst('/', '')->__toString();
        foreach ($this->routes as $route) {
            if ($route->getRoute()->uri === $currentUri) {
                return $route;
            };
        }
        return null;
    }

    public function __call($method, $args)
    {
        if (LadminConfig::getPrefix()) {
            $args[0] = '/' . LadminConfig::getPrefix() . $args[0];
        }
        $router = Route::make()->{$method}(...$args)->name($this->generateName($args[0]));
        $this->routes[] = $router;
        return $router;
    }

    private function _crudRouting(LadminQuery $query, CrudController $controller, string $method, string $crudAction, string $actionName, string|null $primaryKey = null): mixed
    {
        $uri = "/{$query->getTable()}/$crudAction" . ($primaryKey ? "/$primaryKey" : '');
        return $this->{$method}($uri, [$controller::class, $actionName])
            ->setTableName($query->getTable())
            ->setGroupName($query->getTable())
            ->setLabel($query->getTable())
            ->setCrudAction($crudAction);
    }

    private function _show(LadminQuery $query, CrudController $controller): mixed
    {
        return $this->_crudRouting($query,  $controller, 'get', config('ladmin.uri.show'), 'show')->setNavigation(['navigation']);
    }

    private function _detail(LadminQuery $query, CrudController $controller): mixed
    {
        return $this->_crudRouting($query,  $controller, 'get', config('ladmin.uri.detail'), 'detail', '{primaryKey}');
    }

    private function _edit(LadminQuery $query, CrudController $controller): mixed
    {
        return $this->_crudRouting($query,  $controller, 'get', config('ladmin.uri.edit'), 'edit', '{primaryKey?}');
    }

    private function _create(LadminQuery $query, CrudController $controller): mixed
    {
        return $this->_crudRouting($query,  $controller, 'post', config('ladmin.uri.create'), 'create');
    }

    private function _update(LadminQuery $query, CrudController $controller): mixed
    {
        return $this->_crudRouting($query,  $controller, 'post', config('ladmin.uri.update'), 'update', '{primaryKey?}');
    }

    private function _destroy(LadminQuery $query, CrudController $controller): mixed
    {
        return $this->_crudRouting($query,  $controller, 'post', config('ladmin.uri.destroy'), 'destroy', '{primaryKey?}');
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

    public function dashboard(string $controllerName = DashboardController::class): mixed
    {
        return $this->get('/dashboard', [$controllerName, 'index'])
            ->setGroupName('dashboard')
            ->setLabel('Dashboard')
            ->setNavigation(['navigation']);
    }

    public function profile(string $controllerName = ProfileController::class): mixed
    {
        $this->post('/profile/update', [$controllerName, 'update'])->name($this->generateName('/profile/update'));
        $this->post('/profile/password-change', [$controllerName, 'passwordChange'])->name($this->generateName('/profile/password-change'));
        return $this->get('/profile', [$controllerName, 'index'])
            ->setGroupName('profile')
            ->setLabel('Profile')
            ->setNavigation(['dropdown']);
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

    private function generateName(string $uri)
    {
        $name = Str::of($uri)->replace('/', '.')->replaceFirst('.', '');
        return $name->__toString();
    }
}
