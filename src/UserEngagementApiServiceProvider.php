<?php

namespace Schierproducts\UserEngagementApi;

use Illuminate\Support\ServiceProvider;
use Schierproducts\UserEngagementApi\Commands\ImportEngineers;
use Schierproducts\UserEngagementApi\Commands\ImportEvents;

class UserEngagementApiServiceProvider extends ServiceProvider
{
    private $config = 'user-engagement-api';

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/'.$this->config.'.php' => config_path($this->config.'.php'),
            ], 'config');

            // Registering package commands.
             $this->commands([
                 ImportEngineers::class,
                 ImportEvents::class,
             ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/'.$this->config.'.php', $this->config);

        // Register the main class to use with the facade
        $this->app->singleton('userEngagementApi', function() {
            return new UserEngagementApi();
        });
    }
}
