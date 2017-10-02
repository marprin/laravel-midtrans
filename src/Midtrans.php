<?php
namespace Marprinhm\Midtrans;

use Exception;
use GuzzleHttp\Client;

class Midtrans {
    private static $server_key;
    private static $is_production;

    CONST SNAP_SANDBOX_BASE_URL = 'https://app.sandbox.midtrans.com/snap/v1';
    CONST SNAP_PRODUCTION_BASE_URL = 'https://app.midtrans.com/snap/v1';

    public function __construct($server_key, $is_production) {
        self::$server_key = $server_key;
        self::$is_production = !$is_production;
    }

    public static function baseUrl() {
        return (self::$is_production) ? self::SNAP_PRODUCTION_BASE_URL : self::SNAP_SANDBOX_BASE_URL;
    }

    public static function status($order_id) {
        return ;
    }

    /**
    * Approve challenge transaction
    * @param string $order_id => order_id or transaction_id
    * @return string
    */
    public static function approve($order_id) {

    }

    /**
    * Approve challenge transaction
    * @param string $order_id => order_id or transaction_id
    * @return string
    */
    public static function cancel($order_id) {

    }

    /**
    * Approve challenge transaction
    * @param string $order_id => order_id or transaction_id
    * @return string
    */
    public static function expire($order_id) {

    }
}