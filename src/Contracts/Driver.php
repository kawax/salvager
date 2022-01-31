<?php

namespace Revolution\Salvager\Contracts;

use Facebook\WebDriver\Remote\RemoteWebDriver;

interface Driver
{
    /**
     * @return RemoteWebDriver;
     */
    public function create(): RemoteWebDriver;

    /**
     * @return void
     */
    public function start();

    /**
     * @return void
     */
    public function stop();
}
