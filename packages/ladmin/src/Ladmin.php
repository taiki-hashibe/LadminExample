<?php

namespace LowB\Ladmin;

use Exception;
use LowB\Ladmin\Route\Facades\LadminRoute;
use LowB\Ladmin\Route\Route;
use LowB\Ladmin\Support\Facades\LadminQueryManager;
use LowB\Ladmin\Support\RenderableArray;

class Ladmin
{
    public function currentQuery()
    {
        $currentRoute = LadminRoute::getCurrentRoute();
        if (!$currentRoute) {
            throw new Exception("Current route is not available.");
        }
        $currentTableName = $currentRoute->getTableName();
        if (!$currentTableName) {
            throw new Exception("Current table name is not available.");
        }
        $currentQuery = LadminQueryManager::getQuery($currentTableName);
        if (!$currentQuery) {
            throw new Exception("Query for table '$currentTableName' is not available.");
        }
        return $currentQuery;
    }

    private function _currentItem(): mixed
    {
        $primaryKey = request()->primaryKey;
        $query = $this->currentQuery();
        $currentItem = $query->where($query->primaryKey, $primaryKey)->first();
        return $currentItem;
    }

    public function hasCurrentItem(): bool
    {
        return $this->_currentItem() !== null;
    }

    public function currentItem()
    {
        $primaryKey = request()->primaryKey;
        $currentItem = $this->_currentItem();
        if ($currentItem === null) {
            throw new Exception("Current item with primary key '$primaryKey' not found.");
        }
        return $currentItem;
    }

    public function getNavigation(?string $name = null)
    {
        $navigation = new RenderableArray();
        $routes = LadminRoute::getRoutes();
        foreach ($routes as $route) {
            if (count($route->getNavigation()) === 0) {
                continue;
            }
            if ($name) {
                if (in_array($name, $route->getNavigation())) {
                    $navigation->register($route->toNavigation());
                }
            } else {
                $navigation->register($route->toNavigation());
            }
        }
        return $navigation;
    }

    public function getCurrentCrudGroup(): array|null
    {
        $currentRoute = LadminRoute::getCurrentRoute();
        if (!$currentRoute) {
            return null;
        }
        $currentGroupName = $currentRoute->getGroupName();
        if (!$currentGroupName) {
            return null;
        }
        $crud = [];
        foreach (LadminRoute::getRoutes() as $route) {
            if ($route->getGroupName() === $currentGroupName) {
                $crud[] = $route;
            }
        }
        return $crud;
    }

    private function getCrudAction(string $crudAction): Route
    {
        $currentCrudGroup = $this->getCurrentCrudGroup();
        if (!$currentCrudGroup) {
            throw new Exception("Current CRUD group is not available.");
        }
        foreach ($currentCrudGroup as $route) {
            if ($route->getCrudAction() === $crudAction) {
                return $route;
            }
        }
        throw new Exception("CRUD action '$crudAction' is not found in the current group.");
    }

    public function getShow(): Route
    {
        return $this->getCrudAction(config('ladmin.uri.show'));
    }

    public function getShowUri(): string
    {
        return $this->getShow()->getRoute()->uri;
    }

    public function getShowRouteName(): string
    {
        return $this->getShow()->getRoute()->action['as'];
    }

    public function getDetail(): Route
    {
        return $this->getCrudAction(config('ladmin.uri.detail'));
    }

    public function getDetailUri(): string
    {
        return $this->getDetail()->getRoute()->uri;
    }

    public function getDetailRouteName(): string
    {
        return $this->getDetail()->getRoute()->action['as'];
    }

    public function getEdit(): Route
    {
        return $this->getCrudAction(config('ladmin.uri.edit'));
    }

    public function getEditUri(): string
    {
        return $this->getEdit()->getRoute()->uri;
    }

    public function getEditRouteName(): string
    {
        return $this->getEdit()->getRoute()->action['as'];
    }

    public function getCreate(): Route
    {
        return $this->getCrudAction(config('ladmin.uri.create'));
    }

    public function getCreateUri(): string
    {
        return $this->getCreate()->getRoute()->uri;
    }

    public function getCreateRouteName(): string
    {
        return $this->getCreate()->getRoute()->action['as'];
    }

    public function getUpdate(): Route
    {
        return $this->getCrudAction(config('ladmin.uri.update'));
    }

    public function getUpdateUri(): string
    {
        return $this->getUpdate()->getRoute()->uri;
    }

    public function getUpdateRouteName(): string
    {
        return $this->getUpdate()->getRoute()->action['as'];
    }

    public function getDestroy(): Route
    {
        return $this->getCrudAction(config('ladmin.uri.destroy'));
    }

    public function getDestroyUri(): string
    {
        return $this->getDestroy()->getRoute()->uri;
    }

    public function getDestroyRouteName(): string
    {
        return $this->getDestroy()->getRoute()->action['as'];
    }

    public function hasCrudAction(string $crudAction): bool
    {
        $currentCrudGroup = $this->getCurrentCrudGroup();
        if (!$currentCrudGroup) {
            return false;
        }
        foreach ($currentCrudGroup as $route) {
            if ($route->getCrudAction() === $crudAction) {
                return true;
            }
        }
        return false;
    }

    public function hasShow(): bool
    {
        return $this->hasCrudAction(config('ladmin.uri.show'));
    }

    public function hasDetail(): bool
    {
        return $this->hasCrudAction(config('ladmin.uri.detail'));
    }

    public function hasEdit(): bool
    {
        return $this->hasCrudAction(config('ladmin.uri.edit'));
    }

    public function hasCreate(): bool
    {
        return $this->hasCrudAction(config('ladmin.uri.create'));
    }

    public function hasUpdate(): bool
    {
        return $this->hasCrudAction(config('ladmin.uri.update'));
    }

    public function hasDestroy(): bool
    {
        return $this->hasCrudAction(config('ladmin.uri.destroy'));
    }
}
