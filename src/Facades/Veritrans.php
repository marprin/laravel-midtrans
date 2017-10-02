<?php
namespace Marprinhm\Midtrans\Facades;

use Illuminate\Support\Facades\Facade as IlluminateFacade;
use Marprinhm\Midtrans\Veritrans as VeritransClass;

class Veritrans extends IlluminateFacade {
    /**
    * Get the registered name of component.
    * @return string
    */
    protected static function getFacadeAccessor() {
        return VeritransClass::class;
    }
}