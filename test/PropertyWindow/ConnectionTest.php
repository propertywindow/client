<?php
declare(strict_types = 1);

namespace Tests\PropertyWindow;

use PHPUnit\Framework\TestCase;
use PropertyWindow\Client;

/**
 *  Connection Test
 */
class ConnectionTest extends TestCase
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

    public function tearDown()
    {
        $this->client = null;
    }
}
