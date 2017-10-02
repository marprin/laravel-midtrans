<?php
namespace Marprinhm\Midtrans\Contracts;

interface MidtransFactory {
    public static function getSnapToken($data);
    public static function status($order_id);
    public static function approve($order_id);
    public static function cancel($order_id);
    public static function expire($order_id);
}