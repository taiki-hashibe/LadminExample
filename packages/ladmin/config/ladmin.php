<?php

return [
    'index' => null,
    'route' => [
        'prefix' => 'admin',
        'login' => 'login',
        'logout' => 'logout',
        'register' => 'register',
        'dashboard' => 'dashboard',
        'profile' => 'profile',
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
    ],
    'auth' => [
        'middleware' => 'auth',
        'guard' => 'web'
    ]
];
