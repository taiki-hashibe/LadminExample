<?php

return [
    'route' => [
        'prefix' => 'admin',
        'dashboard' => 'dashboard',
        'show' => 'show',
        'detail' => 'detail',
        'editor' => 'editor',
        'create' => 'create',
        'update' => 'update',
        'destroy' => 'destroy'
    ],
    'path' => [
        'controller' => 'App\Http\Controllers\Admin',
    ],
    'namespace' => [
        'controller' => 'App\Http\Controllers\Admin',
    ]
];
