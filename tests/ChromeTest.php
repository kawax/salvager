<?php

namespace Tests;

use Revolution\Salvager\Contracts\Driver;
use Revolution\Salvager\Drivers\Chrome;

class ChromeTest extends TestCase
{
    public function testContract()
    {
        $driver = app(Driver::class);

        $this->assertInstanceOf(Chrome::class, $driver);
    }

    public function testOption()
    {
        $driver = new Chrome([]);

        $this->assertEquals([], $driver->options());
    }

    public function testCreate()
    {
        $driver = new Chrome();

        $this->assertTrue(is_callable([$driver, 'create']));
    }
}
