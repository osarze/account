<?php

namespace Osarze\Account;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AccountServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__. './../routes/api.php');
        $this->loadMigrationsFrom(__DIR__. '/../database/migrations');

        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/../config/account.php' => config_path('account.php'),
            ], 'config');

        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('laravel_account', function($app) {
            return new Account();
        });

        $this->mergeConfigFrom(
            __DIR__.'./../config/account.php',
            'account',
        );
    }
}
