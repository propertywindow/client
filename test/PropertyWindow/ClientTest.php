<?php
declare(strict_types = 1);

namespace Tests\PropertyWindow;

use PHPUnit\Framework\TestCase;
use PropertyWindow\Client;
use PropertyWindow\Properties\Property;

/**
 *  Client Test
 */
class ClientTest extends TestCase
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @return void
     */
    public function setUp(): void
    {
        // todo: mock

        $this->client = new Client('', '', 1);
    }

    /**
     * @throws \Exception
     */
    public function testGetProperty()
    {
        $this->assertInstanceOf(Client::class, $this->client);
//        $property = $this->client->getProperty(1);
//
//        $this->assertEquals(500, $this->client->getStatusCode());
//        $this->assertInstanceOf(Property::class, $property);
    }

    public function tearDown() {
        $this->client = null;
    }
}
