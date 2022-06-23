<?php

namespace Dsmr\Authy;

use Illuminate\Support\ServiceProvider;

class AuthyServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // 
    }

    public function register()
    {
        $this->publishes([
            __DIR__ . '/config/authy.php' => config_path('authy.php'),
        ], 'authy');

        $this->mergeConfigFrom(
            __DIR__ . '/config/authy.php', 'authy'
        );
    }
}
