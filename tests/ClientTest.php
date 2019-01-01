<?php

namespace Tests;

use Revolution\Salvager\Client;
use Revolution\Salvager\Contracts\Factory;
use Revolution\Salvager\Contracts\Driver;
use Revolution\Salvager\Drivers\Chrome;

class ClientTest extends TestCase
{
    /**
     * @var Client
     */
    protected $client;

    public function setUp()
    {
        parent::setUp();

        $this->client = new Client(app(Driver::class));
    }

    public function testInstance()
    {
        $this->assertInstanceOf(Client::class, $this->client);
    }

    public function testFactory()
    {
        $this->assertInstanceOf(Client::class, app(Factory::class));
    }

    public function testDriver()
    {
        $driver = new Chrome([]);
        $this->client->setDriver($driver);

        $this->assertEquals($driver, $this->client->getDriver());
    }

    public function testBrowse()
    {
        $this->assertTrue(is_callable([$this->client, 'browse']));
    }
}
