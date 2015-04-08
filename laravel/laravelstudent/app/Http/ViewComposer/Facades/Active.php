<?php namespace App\Http\ViewComposer\Facades;

use Illuminate\Support\Facades\Facade;

class Active extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'active';
    }
}