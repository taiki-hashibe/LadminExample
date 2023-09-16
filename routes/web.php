<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use LowB\Ladmin\Facades\Crud\Crud;
use LowB\Ladmin\Facades\Ladmin;
use LowB\Ladmin\Support\Facades\LadminRoute;

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

LadminRoute::add(function () {
    LadminRoute::crud(User::class);
});
LadminRoute::route();
Route::get('/', function () {
    dump(1);
});
