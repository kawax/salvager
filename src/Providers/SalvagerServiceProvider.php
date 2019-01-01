<?php

namespace Revolution\Salvager\Providers;

use Illuminate\Support\ServiceProvider;

use Laravel\Dusk\Browser;
use Illuminate\Support\Facades\File;

use Symfony\Component\DomCrawler\Crawler;

use Revolution\Salvager\Contracts\Factory;
use Revolution\Salvager\Client;

use Revolution\Salvager\Contracts\Driver;
use Revolution\Salvager\Drivers\Chrome;

class SalvagerServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/salvager.php' => config_path('salvager.php'),
        ]);

        Browser::$storeScreenshotsAt = $this->mkdir('screenshots');
        Browser::$storeConsoleLogAt = $this->mkdir('console');

        Browser::macro('crawler', function () {
            return new Crawler(
                $this->driver->getPageSource() ?? '',
                $this->driver->getCurrentURL() ?? ''
            );
        });
    }

    /**
     * @param string $name
     *
     * @return string
     */
    private function mkdir(string $name): string
    {
        $path = config('salvager.' . $name, storage_path('salvager/' . $name));
        File::makeDirectory($path, 0755, true, true);

        return $path;
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/salvager.php', 'salvager');

        $this->app->singleton(Factory::class, Client::class);

        $this->app->singleton(Driver::class, function ($app) {
            return new Chrome(config('salvager.chrome'));
        });
    }
}
