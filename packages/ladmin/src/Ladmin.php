<?php

namespace LowB\Ladmin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Request;
use LowB\Ladmin\Crud\Crud;

class Ladmin
{
    public array $crudList = [];
    protected array $routes = [];
    protected array $routeNames = [];

    public function addRoute(string $route)
    {
        $this->routes[] = $route;
        $this->routes = array_unique($this->routes);
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function addRouteName(string $routeName)
    {
        $this->routeNames[] = $routeName;
        $this->routeNames = array_unique($this->routeNames);
    }

    public function getRouteNames()
    {
        return $this->routeNames;
    }

    public function crud()
    {
        foreach ($this->crudList as $crud) {
            if (Request::routeIs($crud->getRouteName())) {
                return $crud;
            }
        }
    }

    public function crudRegister(Crud $crud)
    {
        $this->crudList[] = $crud;
    }

    public function getNavigation(string|null $key = null)
    {
        if (!$key) {
            return $this->crudList;
        }
        $navigation = [];
        foreach ($this->crudList as $crud) {
            if (in_array($key, $crud->getNavigation())) {
                $navigation[] = $crud;
            }
        }
        return $navigation;
    }

    public function query()
    {
        return $this->crud()->getQuery();
    }

    public function currentPrimaryKey()
    {
        if (!request()->primaryKey) {
            return null;
        };
        $primaryKey = request()->primaryKey;
        return $primaryKey;
    }

    public function currentItem()
    {
        if (!request()->primaryKey) {
            return null;
        };
        $primaryKey = request()->primaryKey;
        $query = $this->query();
        if ($query instanceof Model) {
            return $query->where($this->crud()->getPrimaryKey(), $primaryKey)->first();
        }
        if ($query instanceof Builder) {
            return $query->where($this->crud()->getPrimaryKey(), $primaryKey)->first();
        }
        return null;
    }

    public function currentItemUpdate(mixed $values)
    {
        if (!request()->primaryKey) {
            return null;
        };
        $primaryKey = request()->primaryKey;
        $query = $this->query();
        if ($query instanceof Model) {
            return $query->where($this->crud()->getPrimaryKey(), $primaryKey)->first()->update($values);
        }
        if ($query instanceof Builder) {
            return $query->where($this->crud()->getPrimaryKey(), $primaryKey)->update($values);
        }
        return null;
    }
}
