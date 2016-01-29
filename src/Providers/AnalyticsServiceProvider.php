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
        $this->publishes([__DIR__ . '/../../config/analytics.php' => config_path('analytics.php')], 'config');

        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'analytics');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'analytics');

        $this->mergeConfigFrom(
            __DIR__ . '/../../config/analytics.php', 'analytics'
        );

        if (!$this->app->routesAreCached() && config('analytics.default_routes', true)) {
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
