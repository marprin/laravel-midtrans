<?php
namespace Marprinhm\Midtrans\Facades;

use Illuminate\Support\Facades\Facade as IlluminateFacade;
use Marprinhm\Midtrans\Midtrans as MidtransClass;

class Midtrans extends IlluminateFacade {
    /**
    * Get the registered name of component.
    * @return string
    */
    protected static function getFacadeAccessor() {
        return MidtransClass::class;
    }
}