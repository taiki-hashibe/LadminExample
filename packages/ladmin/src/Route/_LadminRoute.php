<?php

namespace LowB\Ladmin\Route;

use Illuminate\Contracts\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use LowB\Ladmin\Controllers\AuthController;
use LowB\Ladmin\Controllers\DashboardController;
use LowB\Ladmin\Controllers\ProfileController;
use LowB\Ladmin\Crud\Crud;

class LadminRoute
{
    use Basically, CrudRoute;

    public function auth(): void
    {
        $this->post(config('ladmin.auth.logout.url'), [AuthController::class, 'logout'], config('ladmin.auth.logout.name'))->middleware(config('ladmin.auth.middleware'));
        $this->match(['GET', 'POST'], config('ladmin.auth.login.name'), [AuthController::class, 'login'], config('ladmin.auth.login.name'));
    }

    public function dashboard(): void
    {
        $this->get(config('ladmin.dashboard.show.url'), [DashboardController::class, 'show'], config('ladmin.dashboard.show.name'))->middleware(config('ladmin.auth.middleware'));
    }

    public function profile(): void
    {
        $this->get(config('ladmin.profile.show.url'), [ProfileController::class, 'show'], config('ladmin.profile.show.name'))->middleware(config('ladmin.auth.middleware'));
        $this->post(config('ladmin.profile.update.url'), [ProfileController::class, 'update'], config('ladmin.profile.update.name'))->middleware(config('ladmin.auth.middleware'));
        $this->post(config('ladmin.profile.destroy.url'), [ProfileController::class, 'destroy'], config('ladmin.profile.destroy.name'))->middleware(config('ladmin.auth.middleware'));
    }

    public function crud(string $modelClassOrTableName, ?string $displayKey = null): Crud
    {
        $this->detail($modelClassOrTableName, $displayKey);
        $this->editor($modelClassOrTableName, $displayKey);
        $this->create($modelClassOrTableName, $displayKey);
        $this->update($modelClassOrTableName, $displayKey);
        $this->destroy($modelClassOrTableName, $displayKey);
        $showCrud = $this->show($modelClassOrTableName, $displayKey);
        return $showCrud;
    }

    protected function createInstance(string $modelClassOrTableName): Model | QueryBuilder
    {
        if (class_exists($modelClassOrTableName) && is_subclass_of($modelClassOrTableName, 'Illuminate\Database\Eloquent\Model')) {
            return app()->make($modelClassOrTableName);
        } else {
            return DB::table($modelClassOrTableName);
        }
    }
}
