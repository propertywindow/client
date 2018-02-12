<?php
declare(strict_types = 1);

namespace PropertyWindow;

use GuzzleHttp\Psr7\Response;

/**
 * Class Connection
 */
class Connection
{
    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * @var string
     */
    protected $baseUrl = 'https://engine.propertywindow.nl';

    /**
     * @var array
     */
    public $token;

    /**
     * @var Response
     */
    protected $response;

    /**
     * @var array
     */
    protected $decoded = [];

    /**
     * @param string $email
     * @param string $password
     *
     * @throws \Exception
     */
    public function __construct(string $email, string $password)
    {
        if (empty($this->token)) {
            $this->generateToken($email, $password);
        }

        $this->client = new \GuzzleHttp\Client([
            'base_uri' => $this->baseUrl,
            'headers'  => [
                'Authorization' => 'Basic ' . $this->token['token'],
                'Content-Type'  => 'application/json',
            ],
        ]);
    }

    /**
     * @param string $path
     * @param string $operation
     * @param array  $parameters
     *
     * @return array|null
     * @throws \Exception
     */
    public function call(string $path, string $operation, array $parameters = []): ?array
    {
        $body           = $this->createBody($operation, $parameters);
        $this->response = $this->client->post($path, $body);

        $this->setDecoded(json_decode($this->response->getBody()->getContents(), true));
        $this->checkResponse();

        return array_key_exists('result', $this->decoded) ? $this->decoded["result"] : null;
    }

    /**
     * @param string $operation
     * @param array  $parameters
     *
     * @return array
     * @throws \Exception
     */
    protected function createBody(string $operation, array $parameters)
    {
        return [
            'body' => json_encode(
                [
                    'jsonrpc' => '2.0',
                    'method'  => $operation,
                    'params'  => $parameters,
                ]
            ),
        ];
    }

    /**
     * @param string $email
     * @param string $password
     *
     * @throws \Exception
     */
    protected function generateToken(string $email, string $password)
    {
        $client   = new \GuzzleHttp\Client();
        $body     = $this->createBody('login', ['email' => $email, 'password' => $password]);
        $response = $client->post($this->baseUrl . '/authentication/login', $body);

        $this->setDecoded(json_decode($response->getBody()->getContents(), true));
        $this->checkResponse();

        $this->token = array_key_exists('result', $this->decoded) ? $this->decoded['result'] : null;
    }

    /**
     * @throws \Exception
     */
    public function checkResponse()
    {
        if (array_key_exists('error', $this->getDecoded())) {
            throw new \Exception($this->getDecoded()['error']['message']);
        }
    }

    /**
     * @return array|null
     */
    public function getToken(): ?array
    {
        return $this->token;
    }

    /**
     * @param array $decoded
     */
    public function setDecoded(array $decoded): void
    {
        $this->decoded = $decoded;
    }

    /**
     * @return array
     */
    public function getDecoded(): array
    {
        return $this->decoded;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->response->getStatusCode();
    }
}
