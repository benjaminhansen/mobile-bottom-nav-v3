<?php

namespace Hammadzafar05\MobileBottomNav\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Hammadzafar05\MobileBottomNav\MobileBottomNav
 */
class MobileBottomNav extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Hammadzafar05\MobileBottomNav\MobileBottomNav::class;
    }
}
