<?php
namespace Marprinhm\Midtrans;

use Illuminate\Support\Facades\Facade as IlluminateFacade;
use Marprinhm\Midtrans\Midtrans;

class Facade extends IlluminateFacade {
    /**
    * Get the registered name of component.
    * @return string
    */
    protected static function getFacadeAccessor() {
        return Midtrans::class;
    }
}