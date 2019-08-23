<?php

namespace  App\Services\Time\Facades;

use Illuminate\Support\Facades\Facade;

class Time extends Facade {
    /**
     * Get name of binding in IoC container
     *
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'time';
    }
}