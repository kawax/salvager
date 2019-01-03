<?php
/**
 * Plain PHP example
 */

require_once __DIR__ . '/../vendor/autoload.php';

use Laravel\Dusk\Browser;
use Symfony\Component\DomCrawler\Crawler;

use Revolution\Salvager\Client;
use Revolution\Salvager\Drivers\Chrome;

Browser::$storeScreenshotsAt = __DIR__ . '/screenshots/';
Browser::$storeConsoleLogAt = __DIR__ . '/console/';

Browser::macro('crawler', function () {
    return new Crawler($this->driver->getPageSource() ?? '', $this->driver->getCurrentURL() ?? '');
});

$options = [
    '--disable-gpu',
    '--headless',
    '--window-size=1280,720',

    // Docker
    '--no-sandbox',
];

$client = new Client(new Chrome($options));

$client->browse(function (Browser $browser) {
    /**
     * @var Crawler $crawler
     */
    $crawler = $browser->visit('https://hugo-vue-mix.netlify.com/')
                       ->screenshot('vue')
                       ->crawler();

    $crawler->filter('.card-header')->each(function (Crawler $node) {
        dump($node->text());
    });
});
