<?php

namespace LowB\Ladmin\Support;

use Closure;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use LowB\Ladmin\Crud\Crud;
use LowB\Ladmin\Facades\Ladmin;
use LowB\Ladmin\Navigation\Facades\Navigation;

class LadminRoute
{
    public function crud(string $modelClassOrTableName)
    {
        $this->show($modelClassOrTableName);
        $this->detail($modelClassOrTableName);
        return $this;
    }

    public function show(string $modelClassOrTableName)
    {
        $instance = app()->make($modelClassOrTableName);
        if ($instance instanceof Model) {
            $crud = new Crud();
            $crud->model($instance)->show();
            Navigation::addHeaderNavigation($crud);
            Navigation::addFooterNavigation($crud);
        };
        return $this;
    }

    public function detail(string $modelClassOrTableName)
    {
        $instance = app()->make($modelClassOrTableName);
        if ($instance instanceof Model) {
            $crud = new Crud();
            $crud->model($instance)->detail();
        };
        return $this;
    }
}
