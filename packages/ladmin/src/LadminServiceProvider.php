<?php

namespace LowB\Ladmin;

use Illuminate\Support\Facades\Blade;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use LowB\Ladmin\Commands\LadminCommand;

class LadminServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('ladmin')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_ladmin_table')
            ->hasCommand(LadminCommand::class);
        Blade::component('layouts-ladmin', \LowB\Ladmin\View\Components\LadminLayout::class);
        Blade::component('layouts-auth', \LowB\Ladmin\View\Components\AuthLayout::class);
        Blade::component('layout-guest', \LowB\Ladmin\View\Components\GuestLayout::class);
    }
}
