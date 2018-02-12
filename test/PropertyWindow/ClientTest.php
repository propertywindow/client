<?php
declare(strict_types = 1);

namespace Tests\PropertyWindow;

use PHPUnit\Framework\TestCase;
use PropertyWindow\Client;
use PropertyWindow\Properties\Property;
use PropertyWindow\SubTypes\SubType;
use PropertyWindow\Terms\Terms;
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

    /**
     * @throws \Exception
     */
    public function testCheckResponse(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Could not find property with id: 99999');

        try {
            $this->client = new Client('', '');
            $this->client->checkResponse();
        } catch (\Exception $exception) {
            $this->assertEquals('Could not authenticate user', $exception->getMessage());
        }

        $this->client = new Client('michael@annan.co.uk', 'michael');
        $this->client->getProperty(99999);
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

    /**
     * @throws \Exception
     */
    public function testGetTerm()
    {
        $term = $this->client->getTerm(1);

        $this->assertInstanceOf(Terms::class, $term);
    }

    /**
     * @throws \Exception
     */
    public function testGetTerms()
    {
        $terms = $this->client->getTerms();

        foreach ($terms as $term) {
            $this->assertInstanceOf(Terms::class, $term);
        }
    }
}
