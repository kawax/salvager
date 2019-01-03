<?php

namespace Tests;

use Revolution\Salvager\Client;
use Revolution\Salvager\Contracts\Driver;
use Revolution\Salvager\Drivers\Selenium\FireFox;

class FireFoxTest extends TestCase
{
    public function testDriver()
    {
        app()->singleton(Driver::class, FireFox::class);

        $client = new Client(app(Driver::class));

        $driver = new FireFox();

        $this->assertEquals($driver, $client->getDriver());
    }
}
