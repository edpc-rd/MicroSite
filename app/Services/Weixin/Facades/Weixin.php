<?php

namespace App\Services\Weixin\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Access
 * @package App\Services\Access\Facades
 */
class Weixin extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'weixin';
    }
}