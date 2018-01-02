<?php
namespace Marprinhm\Midtrans;

use Exception;
use GuzzleHttp\Client;
use Marprinhm\Midtrans\Contracts\MidtransFactory;

class Midtrans implements MidtransFactory {
    private static $server_key;
    private static $is_production;

    CONST SNAP_SANDBOX_BASE_URL = 'https://app.sandbox.midtrans.com/snap/v1/transactions';
    CONST SNAP_PRODUCTION_BASE_URL = 'https://app.midtrans.com/snap/v1/transactions';

    CONST SANDBOX_API_BASE_URL = 'https://api.sandbox.midtrans.com/v2/';
    CONST PRODUCTION_API_BASE_URL = 'https://api.midtrans.com/v2/';

    public function __construct($server_key, $is_production) {
        self::$server_key = $server_key;
        self::$is_production = $is_production;
    }

    private static function snapChargeUrl() {
        return (self::$is_production) ? self::SNAP_PRODUCTION_BASE_URL : self::SNAP_SANDBOX_BASE_URL;
    }

    private static function baseUrl() {
        return (self::$is_production) ? self::PRODUCTION_API_BASE_URL : self::SANDBOX_API_BASE_URL;
    }

    private static function header() {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode(self::$server_key. ':')
        ];
    }

    private static function clientRequest($url, $type, $data = null) {
        try {
            $client = new Client();
            $request = $client->request($type, $url, [
                    'headers' => self::header(),
                    'verify' => dirname(__FILE__) . '/cert/cacert.pem',
                    'json' => $data
                ]);

            return json_decode((string) $request->getBody());
        } catch (Exception $e) {
            throw new Exception ($e->getMessage() ,$e->getResponse()->getStatusCode());
        }
    }

    public static function getSnapToken($body) {
        $endpoint = self::snapChargeUrl();
        return self::clientRequest($endpoint, 'POST', $body)->token;
    }

    public static function status($order_id) {
        $endpoint = self::baseUrl() . $order_id . '/status';
        return self::clientRequest($endpoint, 'GET');
    }

    /**
    * Approve challenge transaction
    * @param string $order_id => order_id or transaction_id
    * @return string
    */
    public static function approve($order_id) {
        $endpoint = self::baseUrl() . $order_id . '/approve';
        return self::clientRequest($endpoint, 'POST')->status_code;
    }

    /**
    * Approve challenge transaction
    * @param string $order_id => order_id or transaction_id
    * @return string
    */
    public static function cancel($order_id) {
        $endpoint = self::baseUrl() . $order_id . '/cancel';
        return self::clientRequest($endpoint, 'POST')->status_code;
    }

    /**
    * Approve challenge transaction
    * @param string $order_id => order_id or transaction_id
    * @return string
    */
    public static function expire($order_id) {
        $endpoint = self::baseUrl() . $order_id . '/expire';
        return self::clientRequest($endpoint, 'POST');
    }
}