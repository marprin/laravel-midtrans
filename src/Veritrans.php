<?php
namespace Marprinhm\Midtrans;

use Exception;
use Marprinhm\Midtrans\Contracts\VeritransFactory;

class Veritrans implements VeritransFactory {
    private static $server_key;
    private static $is_production;

    CONST SANDBOX_BASE_URL = 'https://api.sandbox.veritrans.co.id/v2';
    CONST PRODUCTION_BASE_URL = 'https://api.veritrans.co.id/v2';

    public function __construct($server_key, $is_production) {
        self::$server_key = $server_key;
        self::$is_production = $is_production;
    }

    public static function baseUrl() {
        return (self::$is_production) ? self::PRODUCTION_BASE_URL : self::SANDBOX_BASE_URL;
    }

    private static function header() {
        return [
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: Basic' . base64_encode(self::$server_key . ':')
        ];
    }

    private static function clientRequest($url, $type, $data = null) {
        try {
            return $this->client->request($type, $url, [
                    'headers' => self::header(),
                    'verify' => dirname(__FILE__) . '/cert/cacert.pem',
                    'json' => $data
                ]);
        } catch (Exception $e) {

        }
    }

    public static function vtweb_charge($body) {
        $endpoint = self::baseUrl() . '/charge';
        return self::clientRequest($endpoint, 'POST', $body);
    }

    public static function status($order_id) {
        $endpoint = self::baseUrl() . '/' . $order_id . '/status';
        return self::clientRequest($endpoint, 'GET');
    }

    /**
    * Approve challenge transaction
    * @param string $order_id => order_id or transaction_id
    * @return string
    */
    public static function approve($order_id) {
        $endpoint = self::baseUrl() . '/' . $order_id . '/approve';
        return self::clientRequest($endpoint, 'POST');
    }

    /**
    * Approve challenge transaction
    * @param string $order_id => order_id or transaction_id
    * @return string
    */
    public static function cancel($order_id) {
        $endpoint = self::baseUrl() . '/' . $order_id . '/cancel';
        return self::clientRequest($endpoint, 'POST');
    }

    /**
    * Approve challenge transaction
    * @param string $order_id => order_id or transaction_id
    * @return string
    */
    public static function expire($order_id) {
        $endpoint = self::baseUrl() . '/' . $order_id . '/expire';
        return self::clientRequest($endpoint, 'POST');
    }
}