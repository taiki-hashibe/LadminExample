<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use LowB\Ladmin\Facades\Ladmin;
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

LadminRoute::auth();
LadminRoute::dashboard();
LadminRoute::profile();
LadminRoute::crud(User::class)->setLabel('ユーザー');
LadminRoute::crud('posts')->setLabel('投稿');
Route::get('/test', function () {
    Ladmin::getNavigation('navigation')->render();
});

// require __DIR__ . '/admin.php';
