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

    public function testGetDecoded()
    {
        $this->assertInternalType('array', $this->client->getDecoded());
    }

    public function testCheckResponse()
    {
        $this->expectException(\Exception::class);

        $this->client = new Client('', '');
        $decoded      = $this->client->getDecoded();

        $this->assertArrayHasKey('error', $decoded);
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
    public function testGetProperties()
    {
        $properties = $this->client->getProperties();

        foreach ($properties as $property) {
            $this->assertInstanceOf(Property::class, $property);
        }
    }

    /**
     * @throws \Exception
     */
    public function testGetType()
    {
        $type = $this->client->getType(1);

        $this->assertEquals(200, $this->client->getStatusCode());
        $this->assertInstanceOf(Type::class, $type);
    }

    /**
     * @throws \Exception
     */
    public function testGetTypes()
    {
        $types = $this->client->getTypes();

        foreach ($types as $type) {
            $this->assertInstanceOf(Type::class, $type);
        }
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

    /**
     * @throws \Exception
     */
    public function testGetSubTypes()
    {
        $subTypes = $this->client->getSubTypes();

        foreach ($subTypes as $subType) {
            $this->assertInstanceOf(SubType::class, $subType);
        }
    }

    public function tearDown()
    {
        $this->client = null;
    }
}
