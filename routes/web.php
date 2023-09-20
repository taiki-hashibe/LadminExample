<?php

use App\Models\User;
use LowB\Ladmin\Route\Facades\LadminRoute;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

LadminRoute::crud(User::class)->setLabel('ユーザー');
LadminRoute::crud('posts');
LadminRoute::get('/', function () {
    dump(1);
});



// require __DIR__ . '/admin.php';
