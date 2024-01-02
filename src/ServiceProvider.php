<?php

namespace Penobit\Revisionable;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider {
    /**
     * Bootstrap the application services.
     */
    public function boot() {
        $this->publishes([
            __DIR__.'/config/revisionable.php' => config_path('revisionable.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/migrations/' => database_path('migrations'),
        ], 'migrations');
    }

    /**
     * Register the application services.
     */
    public function register() {}

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides() {}
}
