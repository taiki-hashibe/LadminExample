<?php

namespace LowB\Ladmin;

use LowB\Ladmin\Route\Facades\LadminRoute;
use LowB\Ladmin\Support\Facades\LadminQueryManager;
use LowB\Ladmin\Support\RenderableArray;

class Ladmin
{
    public function currentQuery()
    {
        $currentRoute = LadminRoute::getCurrentRoute();
        if (!$currentRoute) {
            return null;
        }
        $currentTableName = $currentRoute->getTableName();
        if (!$currentTableName) {
            return null;
        }
        $currentQuery = LadminQueryManager::getQuery($currentTableName);
        return $currentQuery;
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
}
