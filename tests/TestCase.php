<?php

namespace Tests;

use Revolution\Salvager\Providers\SalvagerServiceProvider;
use Revolution\Salvager\Facades\Salvager;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            SalvagerServiceProvider::class,
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
     * @param  \Illuminate\Foundation\Application $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('salvager.screenshots', __DIR__ . '/../examples/screenshots/');
        $app['config']->set('salvager.console', __DIR__ . '/../examples/console/');

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
