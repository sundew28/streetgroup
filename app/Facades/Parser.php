<?php

namespace App\Facades;

use App\Managers\ParserManager;
use Closure;
use Illuminate\Support\Facades\Facade;
use RuntimeException;

/**
 * @method static ParserManager getDefaultDriver()
 * @method static ParserManager driver(string $name)
 * @method static ParserManager extend(string $driver, Closure $callback)
 * @method static mixed run($data)
 */
class Parser extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return 'Parser';
    }

}