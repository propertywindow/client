<?php
declare(strict_types = 1);

namespace Tests\PropertyWindow;

use PHPUnit\Framework\TestCase;
use PropertyWindow\Client;
use PropertyWindow\Properties\Property;
use PropertyWindow\SubTypes\SubType;
use PropertyWindow\Types\Type;

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
        // todo: Mock connection
        $this->client = new Client('michael@annan.co.uk', 'michael');

        $this->assertInstanceOf(Client::class, $this->client);
    }

    public function testGetToken()
    {
        $this->assertArrayHasKey('user_id', $this->client->getToken());
        $this->assertArrayHasKey('token', $this->client->getToken());
    }

    /**
     * @throws \Exception
     */
    public function testGetProperty()
    {
        $property = $this->client->getProperty(1);

        $this->assertEquals(200, $this->client->getStatusCode());
        $this->assertInstanceOf(Property::class, $property);
    }

    /**
     * @throws \Exception
     */
    public function testGetSubType()
    {
        $subType = $this->client->getSubType(1);

        $this->assertEquals(200, $this->client->getStatusCode());
        $this->assertInstanceOf(SubType::class, $subType);
        $this->assertInstanceOf(Type::class, $subType->getType());
    }

    public function tearDown()
    {
        $this->client = null;
    }
}
