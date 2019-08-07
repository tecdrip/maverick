<?php

namespace Travierm\Maverick;

use travierm\Maverick;
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
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->publishes([
            __DIR__.'/config/maverick.php' => config_path('maverick.php'),
        ]);
    }
}
