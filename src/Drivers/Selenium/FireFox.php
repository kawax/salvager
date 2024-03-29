<?php

namespace Revolution\Salvager\Drivers\Selenium;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Revolution\Salvager\Contracts\Driver;

class FireFox implements Driver
{
    /**
     * @return RemoteWebDriver
     */
    public function create(): RemoteWebDriver
    {
        return RemoteWebDriver::create(
            'http://localhost:4444/wd/hub', DesiredCapabilities::firefox()
        );
    }

    /**
     * @return void
     */
    public function start()
    {
        //
    }

    /**
     * @return void
     */
    public function stop()
    {
        //
    }
}
