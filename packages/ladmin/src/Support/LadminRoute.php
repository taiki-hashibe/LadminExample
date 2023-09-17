<?php

namespace LowB\Ladmin\Support;

use LowB\Ladmin\Config\Facades\LadminConfig;
use Illuminate\Support\Str;

class LadminRoute
{
    public function route(string $table, string $crud, string|int|null $primaryKey = null)
    {
        $prefix = LadminConfig::prefix() ? config('ladmin.route.prefix') : '';
        $route = '/' . $prefix . LadminConfig::route();
        $route = Str::of($route)->replace('{table}', $table);
        $route = Str::of($route)->replace('{crud}', $crud);
        if (!$primaryKey) {
            $route = Str::of($route)->remove('/{primaryKey}');
        }
        return $route;
    }

    public function routeName(string $table, string $crud)
    {
        $prefix = LadminConfig::prefix() ? config('ladmin.route.prefix') : '';
        $route = $prefix . LadminConfig::route();
        $route = Str::of($route)->replace('{table}', $table);
        $route = Str::of($route)->replace('{crud}', $crud);
        $route = Str::of($route)->remove('/{primaryKey}');
        $route = Str::of($route)->replace('/', '.');
        return $route;
    }

    public function getCurrentTable()
    {
        $route = LadminConfig::route();
        $prefix = LadminConfig::prefix();
        $url = request()->getPathInfo();

        $routeArray = preg_split("/[\/]/", Str::after($route, '/'));
        $urlArray = preg_split("/[\/]/", Str::after($url, '/'));
        $tableIndex = array_search('{table}', $routeArray);
        $table = $urlArray[$tableIndex + $prefix ? 1 : 0];
        return $table;
    }

    public function isCurrentTable(string $table)
    {
        $currentTable = $this->getCurrentTable();
        return $currentTable === $table;
    }
}
