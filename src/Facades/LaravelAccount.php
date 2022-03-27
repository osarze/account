<?php

namespace Osarze\Account\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelAccount extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel_account';
    }
}