<?php
namespace Marprinhm\Midtrans\Contracts;

interface VeritransFactory {
    public static function vtweb_charge($data);
    public static function status($order_id);
    public static function approve($order_id);
    public static function cancel($order_id);
    public static function expire($order_id);
}