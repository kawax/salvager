<?php

namespace Tests;

use Laravel\Dusk\Browser;
use Symfony\Component\DomCrawler\Crawler;

use Revolution\Salvager\Facades\Salvager;

class BrowseTest extends TestCase
{
    public function testBrowse()
    {
        Salvager::browse(function (Browser $browser) use (&$crawler) {
            $crawler = $browser->visit('https://example.com/')
                               ->screenshot('example')
                               ->crawler();
        });

        $this->assertInstanceOf(Crawler::class, $crawler);
        $this->assertEquals('https://example.com/', $crawler->getUri());
    }

    public function testMultiBrowse()
    {
        Salvager::browse(function (Browser $browser, Browser $browser2) use (&$crawler, &$crawler2) {
            $crawler = $browser->visit('https://example.com/')
                               ->crawler();

            $crawler2 = $browser2->visit('https://example.org/')
                                 ->crawler();
        });

        $this->assertEquals('https://example.com/', $crawler->getUri());
        $this->assertEquals('https://example.org/', $crawler2->getUri());
    }
}
