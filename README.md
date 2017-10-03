# laravel-midtrans

## Instalation

First, require the package in composer.json by

    composer require marprinhm/midtrans dev-master

After require the package, open `config/app.php` to add the ServiceProvider and Facade by following below:

    Marprinhm\Midtrans\MidtransServiceProvider::class,

For the convenience when using the package, you can optionally add the Facade too by

    'Midtrans' => Marprinhm\Midtrans\Facades\Midtrans::class,
    'Veritrans' => Marprinhm\Midtrans\Facades\Veritrans::class,

There are two facades because the endpoint of the services from Midtrans is different (Veritrans is the old one)
and they already change their names to Midtrans. So, choose your partnership with Midtrans to choose the right Facade for you.

## Configuration

Before using the package, it's better to publish the config file first to make you can set the `environment`, `server_key` and `client_key`

    php artisan vendor:publish --provider="Marprinhm\Midtrans\MidtransServiceProvider"

Running command above will copy a config file to your project directory `config/midtrans.php` and you can set the variable.

## Using

You can create package instance easily by

    App::make('Midtrans');

or

    App::make('Veritrans');

This depends on what type of payment you will use for your payment method.

If you want to use the easiest way by using the facade but make sure to use the facade on top of your file.

    Midtrans::getSnapToken($data);

## Available Function
### Midtrans

    Midtrans::getSnapToken($data);
This will return `string` token.

    Midtrans::status($order_id);


    Midtrans::approve($order_id);
This will return status_code.

    Midtrans::cancel($order_id);
This will return status_code.

    Midtrans::expire($order_id);

### Veritrans

    Veritrans::vtwebCharge($data);
This will return endpoint for merchant redirect user to.

    Veritrans::vtdirectCharge($data);

    
    Veritrans::status($order_id);


    Veritrans::approve($order_id);
This will return status_code.

    Veritrans::cancel($order_id);
This will return status_code.

    Veritrans::expire($order_id);
