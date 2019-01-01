<?php

namespace Revolution\Salvager\Contracts;

use Closure;

interface Factory
{
    /**
     * @param Closure $callback
     *
     * @throws \Exception
     * @throws \Throwable
     */
    public function browse(Closure $callback);
}
