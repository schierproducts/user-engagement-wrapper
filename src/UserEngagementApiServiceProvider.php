<?php

namespace Schierproducts\UserEngagementApi;

use Illuminate\Support\ServiceProvider;

class UserEngagementApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('user-engagement-api.php'),
            ], 'config');

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'user-engagement-api');

        // Register the main class to use with the facade
        $this->app->singleton('user-engagement-api', function () {
            return new UserEngagementApi();
        });
    }
}
