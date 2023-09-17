<?php

namespace LowB\Ladmin;

use Illuminate\Support\Arr;

class Ladmin
{
    public array $app = [
        'navigation' => [
            [
                'application_key' => '',
                'type' => 'dashboard',
                'label' => 'dashboard',
                'tableName' => null,
                'url' => '/admin/dashboard',
                'active' => false,
                'target' => [
                    'header',
                    'footer',
                    'dropdown'
                ]
            ]
        ]
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
