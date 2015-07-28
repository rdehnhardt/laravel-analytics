<?php

namespace Baconfy\Analytics\Providers;

use Illuminate\Support\ServiceProvider;

class AnalyticsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([__DIR__ . '/../../database/migrations/' => database_path('migrations')], 'migrations');
        $this->publishes([__DIR__ . '/../../resources/assets' => public_path()], 'public');

        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'analytics');

        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/../Http/routes.php';
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
