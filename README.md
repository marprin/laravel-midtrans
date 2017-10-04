# Laravel Midtrans/Veritrans Library

## Instalation

First, require the package in composer.json by

    composer require marprinhm/midtrans

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

### Sample for Midtrans Facade

    <?php
    namespace you/project/namespace/controller;

    use Midtrans;

    class Payment {
        public function purchase() {
            $transaction_details = [
                'order_id' => time(),
                'gross_amount' => 10000
            ];
            
            $customer_details = [
                'first_name' => 'User',
                'email' => 'user@gmail.com',
                'phone' => '08238493894'
            ];
            
            $custom_expiry = [
                'start_time' => date("Y-m-d H:i:s O", time()),
                'unit' => 'day',
                'duration' => 2
            ];
            
            $item_details = [
                'id' => 'PROD-1',
                'quantity' => 1,
                'name' => 'Product-1',
                'price' => 10000
            ];

            $transaction_data = [
                'transaction_details' => $transaction_details,
                'item_details' => $item_details,
                'customer_details' => $customer_details,
                'expiry' => $custom_expiry
            ];

            $token = Midtrans::getSnapToken($transaction_data);
            return $token;
        }
    }

### Sample for Veritrans Facade

    <?php
    namespace you/project/namespace/controller;

    use Veritrans;

    class Payment {
        public function purchase() {
            $transaction_details = [
                'order_id' => time(),
                'gross_amount' => 10000
            ];
            
            $customer_details = [
                'first_name' => 'User',
                'email' => 'user@gmail.com',
                'phone' => '08238493894'
            ];
            
            $custom_expiry = [
                'start_time' => date("Y-m-d H:i:s O", time()),
                'unit' => 'day',
                'duration' => 2
            ];
            
            $item_details = [
                'id' => 'PROD-1',
                'quantity' => 1,
                'name' => 'Product-1',
                'price' => 10000
            ];

            $transaction_data = [
                'payment_type' => 'vtweb',
                'vtweb' => [
                    'credit_card_3d_secure' => true
                ],
                'transaction_details' => $transaction_details,
                'item_details' => $item_details,
                'customer_details' => $customer_details
            ];

            $redirect_url = Veritrans::vtwebCharge($transaction_data);
            return $redirect_url;
        }
    }

## Available Function
### Midtrans

    Midtrans::getSnapToken($data);
`getSnapToken` will take `array` data as parameter that passed to the function and will return `string` of token.

    Midtrans::status($order_id);
`status` function will take `order_id` in any type of data (preferable `string` or `integer`) type for requesting the status of payment.

    Midtrans::approve($order_id);
`approve` function will take `order_id` in any type of data (preferable `string` or `integer`) and will return `status_code`.

    Midtrans::cancel($order_id);
`cancel` function will take `order_id` in any type of data (preferable `string` or `integer`) and will return `status_code`.

    Midtrans::expire($order_id);
`expire` function will take `order_id` in any type of data (preferable `string` or `integer`).

### Veritrans

    Veritrans::vtwebCharge($data);
`vtwebCharge` function take `array` data as parameter and will return `string` endpoint for merchant redirect user to.

    Veritrans::vtdirectCharge($data);

    
    Veritrans::status($order_id);
`status` function will take `order_id` in any type of data (preferable `string` or `integer`) type for requesting the status of payment.

    Veritrans::approve($order_id);
`approve` function will take `order_id` in any type of data (preferable `string` or `integer`) and will return `status_code`.

    Veritrans::cancel($order_id);
`cancel` function will take `order_id` in any type of data (preferable `string` or `integer`) and will return `status_code`.

    Veritrans::expire($order_id);
`expire` function will take `order_id` in any type of data (preferable `string` or `integer`).
