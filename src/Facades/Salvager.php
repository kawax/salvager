<?php

namespace Revolution\Salvager\Facades;

use Illuminate\Support\Facades\Facade;
use Revolution\Salvager\Contracts\Driver;
use Revolution\Salvager\Contracts\Factory;

/**
 * Class Salvager.
 *
 * @method void browse(\Closure $callback)
 * @method $this setDriver(Driver $driver)
 */
class Salvager extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Factory::class;
    }
}
