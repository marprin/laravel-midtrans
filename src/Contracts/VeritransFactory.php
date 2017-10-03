<?php
namespace Marprinhm\Midtrans\Contracts;

interface VeritransFactory {
    public static function vtwebCharge($data);
    public static function vtdirectCharge($data);
    public static function status($order_id);
    public static function approve($order_id);
    public static function cancel($order_id);
    public static function expire($order_id);
}