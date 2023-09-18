<?php

use App\Models\Comments;
use App\Models\Post;
use LowB\Ladmin\Facades\Ladmin;
use LowB\Ladmin\Route\Facades\LadminRoute;

LadminRoute::auth();
LadminRoute::dashboard();
// LadminRoute::dashboard(); ダッシュボードのルーティング、Admin/DashboardControllerが存在すれば使う
// LadminRoute::dashboard()->view('admin.dashboard'); ダッシュボードのビューをセット
LadminRoute::profile();
LadminRoute::crud('users', 'name')->label('ユーザー');
LadminRoute::crud(Post::class, 'title')->label('投稿');
LadminRoute::show(Comments::class, 'text')->label('コメント');
// LadminRoute::crud(User::class); この中でshow、detail、editor...のルーティングを完結させ、Ladminにnavigationをセットする、Admin/UserControllerが存在すれば使う
// LadminRoute::show(User::class); showのみ
// LadminRoute::detail(User::class); detailのみ
// LadminRoute::editor(User::class); editorのみ
// LadminRoute::crud(User::class)->navigation(false)->dropdown(true); ドロップダウンにのみ表示
// LadminRoute::crud(User::class)->onlyDropdown(); ドロップダウンにのみ表示

// LadminRoute::crud('users'); テーブル名での指定も可能にしたい
// LadminRoute::crud('users')->setConnection('sqlite'); コネクション指定

// LadminRoute::get('/profile', [ProfileController::class, 'index'], 'profile.index'); プレーンなコントローラー、ほぼRouteと同じ機能、nameは必須にする
