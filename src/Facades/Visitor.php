<?php

namespace Abolaradev\Visitor\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Abolaradev\Visitor\Visitor
 */
class Visitor extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Abolaradev\Visitor\Visitor::class;
    }
}
