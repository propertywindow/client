<?php
declare(strict_types = 1);

namespace Tests\PropertyWindow;

use PHPUnit\Framework\TestCase;
use PropertyWindow\Client;

class ConnectionTest extends TestCase
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
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Could not find property with id: 99999');

        try {
            $this->client = new Client('');
            $this->client->checkResponse();
        } catch (\Exception $exception) {
            $this->assertEquals('No token provided', $exception->getMessage());
        }

        $this->client = new Client($this->token);
        $this->client->getProperty(99999);
    }

    public function tearDown()
    {
        $this->client = null;
    }
}
