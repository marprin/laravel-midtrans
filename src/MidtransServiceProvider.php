<?php

namespace Marprinhm\Midtrans;

use Illuminate\Support\ServiceProvider;
use Marprinhm\Midtrans\Midtrans;
use Marprinhm\Midtrans\Veritrans;

class MidtransServiceProvider extends ServiceProvider
{
    /**
    * Indicates if loading of the provider is deferred
    */
    protected $defer = true;

    /**
    * Config path of midtrans packages
    */
    private $config_path = __DIR__ . '/../config/midtrans.php';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            $this->config_path => config_path('midtrans.php')
        ]);

        require __DIR__ . '/../../../../vendor/autoload.php';
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom($this->config_path, 'midtrans');

        $this->app->singleton(Midtrans::class, function ($app) {
            return new Midtrans($this->app['config']['midtrans.server_key'], $this->app['config']['midtrans.is_production']);
        });

        $this->app->singleton(Veritrans::class, function ($app) {
            return new Veritrans($this->app['config']['midtrans.server_key'], $this->app['config']['midtrans.is_production']);
        });
    }

    public function provides()
    {
        return [Midtrans::class, Veritrans::class];
    }
}
