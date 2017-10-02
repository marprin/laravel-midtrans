<?php

namespace Marprinhm\Midtrans;

use Illuminate\Support\ServiceProvider;

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
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom($this->config_path, 'midtrans');
    }
}
