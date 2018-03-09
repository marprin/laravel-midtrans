<?php
namespace Marprinhm\Midtrans;

use Dotenv\Dotenv;
use Marprinhm\Midtrans\Midtrans;
use PHPUnit_Framework_TestCase;

class MidtransTest extends PHPUnit_Framework_TestCase {

    public function setUp() {
        $dotenv = new Dotenv(__DIR__);
        $dotenv->load();
    }

    public function testCases() {
        $order_id = time();
        $transaction_details = [
            'order_id' => $order_id,
            'gross_amount' => 10000
        ];

        $customer_details = [
            'first_name' => 'user',
            'email' => 'test@gmail.com',
            'phone' => '083493284234'
        ];

        $time = time();
        $custom_expiry = [
            'start_time' => date("Y-m-d H:i:s O",$time),
            'unit' => 'day',
            'duration' => 1
        ];

        $item_details = [
            'id' => 'PROD-1',
            'quantity' => 1,
            'name' => 'Product 1',
            'price' => 10000
        ];

        // Send this options if you use 3Ds in credit card request
        $credit_card_option = [
            'secure' => true,
            'channel' => 'migs'
        ];

        $transaction_data = [
            'transaction_details' => $transaction_details,
            'item_details' => $item_details,
            'customer_details' => $customer_details,
            'expiry' => $custom_expiry,
            'credit_card' => $credit_card_option,
        ];

        $midtrans = new Midtrans(env('MIDTRANS_SERVER_KEY'), env('MIDTRANS_IS_PRODUCTION'));
        $response = $midtrans->getSnapToken($transaction_data);
    }
} 