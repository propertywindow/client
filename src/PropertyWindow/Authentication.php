<?php
declare(strict_types = 1);

namespace PropertyWindow;

use GuzzleHttp\Psr7\Response;

/**
 * Class Authentication
 */
class Authentication
{
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
        $client        = new \GuzzleHttp\Client();
        $body          = $this->createBody('login', ['email' => $email, 'password' => $password]);
        $response      = $client->post($this->baseUrl . '/authentication/login', $body);
        $this->decoded = json_decode($response->getBody()->getContents(), true);
        $result        = array_key_exists('result', $this->decoded) ? $this->decoded["result"] : null;

        $this->checkResponse();

        $this->token = $result;
    }

    /**
     * @throws \Exception
     */
    protected function checkResponse()
    {
        if (empty($this->decoded)) {
            throw new \Exception("Could not parse response from server");
        }

        if (array_key_exists('error', $this->decoded)) {
            throw new \Exception($this->decoded['error']['message']);
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
     * @return array|null
     */
    public function getDecoded(): ?array
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
