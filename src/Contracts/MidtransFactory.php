<?php
namespace Marprinhm\Midtrans\Contracts;

interface MidtransFactory extends BaseFactory {
    public static function getSnapToken($data);
}