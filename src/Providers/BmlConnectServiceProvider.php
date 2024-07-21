<?php

namespace Naeemmv\BmlConnect\Providers;

use Illuminate\Support\ServiceProvider;
use Naeemmv\BmlConnect\BmlConnect;

class BmlConnectServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/bml-connect.php' => config_path('bml-connect.php'),
        ]);
    }

    public function register(): void
    {
        $this->app->singleton(BmlConnect::class, function() {
            return new BmlConnect(
                config('bml-connect.api_key'),
                config('bml-connect.app_id'),
                config('bml-connect.mode', 'sandbox'),
                 []);
        });

    }
}