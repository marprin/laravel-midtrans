<?php
namespace Marprinhm\Midtrans\Contracts;

interface VeritransFactory extends BaseFactory {
    public static function vtwebCharge($data);
    public static function vtdirectCharge($data);
}