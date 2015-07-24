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
        $this->publishes([__DIR__ . '/../../assets' => public_path()], 'public');

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
