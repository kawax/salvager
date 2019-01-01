<?php

namespace Revolution\Salvager;

use Closure;
use Laravel\Dusk\Concerns\ProvidesBrowser;
use Facebook\WebDriver\Remote\RemoteWebDriver;

use Revolution\Salvager\Contracts\Factory;
use Revolution\Salvager\Contracts\Driver;

class Client implements Factory
{
    use ProvidesBrowser {
        browse as parentBrowse;
    }

    /**
     * @var Driver
     */
    private $driver;

    /**
     * Client constructor.
     *
     * @param Driver $driver
     */
    public function __construct(Driver $driver)
    {
        $this->driver = $driver;
    }

    /**
     * @param Closure $callback
     *
     * @throws \Exception
     * @throws \Throwable
     */
    public function browse(Closure $callback)
    {
        $this->driver->start();

        static::afterClass(function () {
            $this->driver->stop();
        });

        $this->parentBrowse($callback);

        static::tearDownDuskClass();
    }

    /**
     * @return RemoteWebDriver
     */
    protected function driver()
    {
        return $this->driver->create();
    }

    /**
     * @return Driver
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * @param Driver $driver
     *
     * @return $this
     */
    public function setDriver(Driver $driver)
    {
        $this->driver = $driver;

        return $this;
    }

    /**
     * @param bool $withDataSet
     *
     * @return string
     */
    protected function getName(bool $withDataSet = true)
    {
        return '';
    }

    public function __destruct()
    {
        try {
            static::tearDownDuskClass();
        } catch (\Exception $e) {
            //
        }
    }
}
