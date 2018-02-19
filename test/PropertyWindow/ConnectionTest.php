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
     * @var string
     */
    private $token = 'eyJ1c2VyIjozMSwicGFzc3dvcmQiOiIwMWNkYzgxYzFlOTYxZjA0YjJmZWVkM2ZmNDhhZTI0MiIsInRpbWVzdGFtcCI6MTUxODc4NDUzNiwic2lnbmF0dXJlIjoiZDc3ZGVkNzBhN2M1Y2RkNjMyOTJiNThmOTZiZDk1NTI4MjAwMDY0MCJ9';

    /**
     * @return void
     */
    public function setUp(): void
    {
        // todo: Mock connection
        $this->client = new Client($this->token);

        $this->assertInstanceOf(Client::class, $this->client);
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
        try {
            $this->client = new Client('');
            $this->client->checkResponse();
        } catch (\Exception $exception) {
            $this->assertEquals('No token provided', $exception->getMessage());
        }
    }

    public function tearDown()
    {
        $this->client = null;
    }
}
