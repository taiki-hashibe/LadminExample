<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use LowB\Ladmin\Config\Facades\LadminConfig;
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

LadminConfig::theme('ladmin-basic-theme');
LadminRoute::auth();
LadminRoute::dashboard()->setLabel('ダッシュボード');
LadminRoute::profile()->setLabel('プロフィール');
LadminRoute::crud(User::class);
LadminRoute::crud('posts');
Route::get('/test', function () {
    Ladmin::getNavigation('navigation')->render();
});
