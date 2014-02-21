<?php namespace Connor4312\WhmcsL4;

use Illuminate\Support\Facades\Facade;

class EsoFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Connor4312\WhmcsL4\Whmcs';
    }
}