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

    public function crud(?string $name = null)
    {
        if ($name) {
            foreach ($this->crudList as $crud) {
                if ($crud->name() === $name) {
                    return $crud;
                }
            }
        }
        foreach ($this->crudList as $crud) {
            if (Request::routeIs($crud->routeName())) {
                return $crud;
            }
        }
    }

    public function crudFindByTableName(string $name)
    {
        foreach ($this->crudList as $crud) {
            if ($crud->tableName() === $name) {
                return $crud;
            }
        }
    }

    public function crudRegister(Crud $crud)
    {
        $this->crudList[] = $crud;
        $this->addRoute($crud->route());
        $this->addRouteName($crud->routeName());
    }

    public function navigation(string|null $key = null)
    {
        if (!$key) {
            return $this->crudList;
        }
        $navigation = [];
        foreach ($this->crudList as $crud) {
            if (in_array($key, $crud->navigation())) {
                $navigation[] = $crud;
            }
        }
        return $navigation;
    }

    public function query()
    {
        return $this->crud()->query();
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
            return $query->where($this->crud()->primaryKey(), $primaryKey)->first();
        }
        if ($query instanceof Builder) {
            return $query->where($this->crud()->primaryKey(), $primaryKey)->first();
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
            return $query->where($this->crud()->primaryKey(), $primaryKey)->first()->update($values);
        }
        if ($query instanceof Builder) {
            return $query->where($this->crud()->primaryKey(), $primaryKey)->update($values);
        }
        return null;
    }

    public function itemDelete(mixed $primaryKey)
    {
        $query = $this->query();
        if ($query instanceof Model) {
            return $query->where($this->crud()->primaryKey(), $primaryKey)->first()->delete();
        }
        if ($query instanceof Builder) {
            return $query->where($this->crud()->primaryKey(), $primaryKey)->delete();
        }
        return null;
    }

    public function index()
    {
        if (config('ladmin.index')) {
            return config('ladmin.index');
        }
        $crudList = [];
        foreach ($this->crudList as $crud) {
            $crudList[] = $crud->toArray();
        }
        if (in_array(config('ladmin.route.dashboard'), array_column($crudList, 'tableName'))) {
            return $this->crudFindByTableName(config('ladmin.route.dashboard'));
        };
        if (in_array(config('ladmin.route.profile'), array_column($crudList, 'tableName'))) {
            return $this->crudFindByTableName(config('ladmin.route.profile'));
        }

        foreach ($this->crudList as $crud) {
            if ($crud->name() !== config('ladmin.route.login') && $crud->name() !== config('ladmin.route.logout') && $crud->name() !== config('ladmin.route.register')) {
                return $crud;
            }
        }
    }

    public function login()
    {
        return $this->crud(config('ladmin.auth.login'));
    }

    public function logout()
    {
        return $this->crud(config('ladmin.auth.logout'));
    }

    public function profile()
    {
        return $this->crud(config('ladmin.profile.show'));
    }

    public function password()
    {
        return $this->crud(config('ladmin.profile.password-update'));
    }

    public function hasProfile()
    {
        return $this->crud(config('ladmin.profile.show'));
    }
}
