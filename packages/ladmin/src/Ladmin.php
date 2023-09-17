<?php

namespace LowB\Ladmin;

use Illuminate\Support\Arr;

class Ladmin
{
    public array $app = [
        'routes' => []
    ];

    public function set(string $key, mixed $value)
    {
        Arr::set($this->app, $key, $value);
    }

    public function get()
    {
        return $this->app;
    }
}
