<?php
namespace Marprinhm\Midtrans;

require_once __DIR__ . '/../vendor/autoload.php';

use Exception;
use GuzzleHttp\Client;
use Marprinhm\Midtrans\Contracts\MidtransFactory;

class Midtrans implements MidtransFactory {
    private static $server_key;
    private static $is_production;
    private $client;

    CONST SNAP_SANDBOX_BASE_URL = 'https://app.sandbox.midtrans.com/snap/v1';
    CONST SNAP_PRODUCTION_BASE_URL = 'https://app.midtrans.com/snap/v1';

    public function __construct($server_key, $is_production) {
        self::$server_key = $server_key;
        self::$is_production = $is_production;
        $this->client = new Client();
    }

    public static function baseUrl() {
        return (self::$is_production) ? self::SNAP_PRODUCTION_BASE_URL : self::SNAP_SANDBOX_BASE_URL;
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

    public static function getSnapToken($body) {
        $endpoint = self::baseUrl() . '/transactions';
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