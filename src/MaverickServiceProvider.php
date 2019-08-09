<?php

namespace Travierm\Maverick;

use Travierm\Maverick;
use Illuminate\Support\ServiceProvider;

class MaverickServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(\Illuminate\Routing\Router $router)
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/views', 'maverick');
        $this->publishes([
            __DIR__.'/config/maverick.php' => config_path('maverick.php'),
        ]);
    }
}
