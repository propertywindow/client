<?php
declare(strict_types = 1);

namespace Tests\PropertyWindow;

use PHPUnit\Framework\TestCase;
use PropertyWindow\Client;
use PropertyWindow\Properties\Property;
use PropertyWindow\SubTypes\SubType;
use PropertyWindow\Terms\Terms;
use PropertyWindow\Types\Type;

class ClientTest extends TestCase
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpYXQiOjE1MzAyNzE1MzMsImp0aSI6IldjbVwvNENUYnJwdUNLSmFLeDhJTW5PcFwvSlwvY0JcL2Vkc0NhMlVuSDF2Vm9zPSIsIm5iZiI6MTUzMDI3MTU0MywiZXhwIjoxNTMwMjcxNjAzLCJ1aWQiOjEwLCJ1Zm4iOiJNaWNoYWVsIEFubmFuIiwiYXZ0IjoiMlwvdXNlcnNcLzEwLmpwZyJ9.qcX5xF36XAKxLv1URHjczYLOwYqTjYv_U4KXLJLUCeY';

    /**
     * @return void
     * @throws \Exception
     */
    public function setUp(): void
    {
        $this->client = new Client($this->token);
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

    public function tearDown()
    {
        $this->client = null;
    }
}
