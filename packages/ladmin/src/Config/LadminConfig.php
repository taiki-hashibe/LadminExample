<?php

namespace LowB\Ladmin\Config;

class LadminConfig
{
    protected string $route = '/{table}/{crud}/{primaryKey}';
    protected string|null $prefix;

    public function __construct()
    {
        $this->prefix = config('ladmin.route.prefix');
    }

    public function getPrefix(): string | null
    {
        return $this->prefix;
    }
}
