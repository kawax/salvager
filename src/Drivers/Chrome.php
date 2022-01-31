<?php

namespace Revolution\Salvager\Drivers;

use Closure;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Laravel\Dusk\Chrome\SupportsChrome;
use Revolution\Salvager\Contracts\Driver;

class Chrome implements Driver
{
    use SupportsChrome;

    /**
     * Chrome constructor.
     *
     * @param  array|null  $options
     */
    public function __construct(private ?array $options = null)
    {
        $this->options = $options ?? [
            '--disable-gpu',
            '--headless',
            '--window-size=1920,1080',
        ];
    }

    /**
     * @return RemoteWebDriver
     */
    public function create(): RemoteWebDriver
    {
        $options = (new ChromeOptions())->addArguments($this->options);
        $remote_server_url = config('salvager.remote_server_url') ?? 'http://localhost:9515';

        return RemoteWebDriver::create(
            $remote_server_url,
            DesiredCapabilities::chrome()->setCapability(
                ChromeOptions::CAPABILITY,
                $options
            )
        );
    }

    /**
     * @return void
     */
    public function start()
    {
        static::startChromeDriver();
    }

    /**
     * @return void
     */
    public function stop()
    {
        static::stopChromeDriver();
    }

    /**
     * @return array
     */
    public function options(): array
    {
        return $this->options;
    }

    /**
     * @param  Closure  $callback
     * @return void
     */
    public static function afterClass(Closure $callback)
    {
        //
    }

    /**
     * @return void
     */
    public function __destruct()
    {
        $this->stop();
    }
}
