<?php

use App\Models\Post;
use App\Models\User;
use LowB\Ladmin\Support\Facades\LadminRoute;

// LadminRoute::auth(); ログイン関連のルーティング

// LadminRoute::dashboard(); ダッシュボードのルーティング、Admin/DashboardControllerが存在すれば使う
// LadminRoute::dashboard()->view('admin.dashboard'); ダッシュボードのビューをセット

LadminRoute::crud(User::class);
LadminRoute::crud(Post::class);
// LadminRoute::crud(User::class); この中でshow、detail、editor...のルーティングを完結させ、Ladminにnavigationをセットする、Admin/UserControllerが存在すれば使う
// LadminRoute::show(User::class); showのみ
// LadminRoute::detail(User::class); detailのみ
// LadminRoute::editor(User::class); editorのみ
// LadminRoute::crud(User::class)->navigation(false)->dropdown(true); ドロップダウンにのみ表示
// LadminRoute::crud(User::class)->onlyDropdown(); ドロップダウンにのみ表示

// LadminRoute::crud('users'); テーブル名での指定も可能にしたい
// LadminRoute::crud('users')->setConnection('sqlite'); コネクション指定

// LadminRoute::crudController(UserController::class); CrudControllerを継承するコントローラーを指定

// LadminRoute::get('/profile', ProfileController::class); プレーンなコントローラー、ほぼRouteと同じ機能
