<?php

namespace Tests;

use Laravel\Dusk\DuskServiceProvider;
use Revolution\Salvager\Facades\Salvager;
use Revolution\Salvager\Providers\SalvagerServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected static bool $driver_installed = false;

    public function setUp(): void
    {
        parent::setUp();

        if (! self::$driver_installed) {
            $this->artisan('dusk:chrome-driver --detect');

            self::$driver_installed = true;
        }
    }

    protected function getPackageProviders($app)
    {
        return [
            SalvagerServiceProvider::class,
            DuskServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Salvager' => Salvager::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('salvager.screenshots', __DIR__.'/../examples/screenshots/');
        $app['config']->set('salvager.console', __DIR__.'/../examples/console/');

        if (env('TEST_ENV') === 'docker') {
            $app['config']->set('salvager.chrome', [
                '--disable-gpu',
                '--headless',
                '--window-size=1920,1080',

                '--no-sandbox',
                '--disable-dev-shm-usage',
            ]);
        }
    }
}
