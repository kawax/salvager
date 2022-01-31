<?php

namespace Revolution\Salvager;

use Closure;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Laravel\Dusk\Concerns\ProvidesBrowser;
use Revolution\Salvager\Contracts\Driver;
use Revolution\Salvager\Contracts\Factory;

class Client implements Factory
{
    use ProvidesBrowser {
        browse as parentBrowse;
    }

    /**
     * Client constructor.
     *
     * @param  Driver  $driver
     */
    public function __construct(private Driver $driver)
    {
        //
    }

    /**
     * @param  Closure  $callback
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
    protected function driver(): RemoteWebDriver
    {
        return $this->driver->create();
    }

    /**
     * @return Driver
     */
    public function getDriver(): Driver
    {
        return $this->driver;
    }

    /**
     * @param  Driver  $driver
     * @return $this
     */
    public function setDriver(Driver $driver): static
    {
        $this->driver = $driver;

        return $this;
    }

    /**
     * @param  bool  $withDataSet
     * @return string
     */
    protected function getName(bool $withDataSet = true): string
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
