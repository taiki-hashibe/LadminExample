<?php

namespace LowB\Ladmin\Config;

class LadminConfig
{
    protected string $route = '/{table}/{crud}/{primaryKey}';
    protected bool $prefix = true;

    public function route(?string $route = null): string
    {
        if ($route) {
            $this->route = $route;
        }
        return $this->route;
    }

    public function prefix(?bool $prefix = null): bool
    {
        if ($prefix) {
            $this->prefix = $prefix;
        }
        return $this->prefix;
    }
}
