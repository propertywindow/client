<?php
declare(strict_types = 1);

namespace PropertyWindow;

use GuzzleHttp\Psr7\Response;

/**
 * Class Authentication
 */
class Authentication
{
    public const PARSE_ERROR            = -32700;
    public const INVALID_REQUEST        = -32600;
    public const METHOD_NOT_FOUND       = -32601;
    public const INVALID_PARAMS         = -32602;
    public const INTERNAL_ERROR         = -32603;
    public const EXCEPTION_ERROR        = -32604;
    public const USER_NOT_AUTHENTICATED = -32000;

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
        $client = new \GuzzleHttp\Client([
            'headers' => ['Content-Type' => 'application/json'],
        ]);

        $response = $client->post($this->baseUrl . '/authentication/login',
            [
                'body' => json_encode(
                    [
                        'jsonrpc' => '2.0',
                        'method'  => 'login',
                        'params'  => [
                            "email"    => $email,
                            "password" => $password,
                        ],
                    ]
                ),
            ]
        );

        $decoded = json_decode($response->getBody()->getContents(), true);
        $result  = array_key_exists('result', $decoded) ? $decoded["result"] : null;

        if (array_key_exists('error', $decoded)) {
            throw new \Exception($decoded['error']['message']);
        }

        if ($result["user_id"] === null) {
            throw new \Exception("Could not authenticate user");
        }

        $this->token = $result;
    }

    /**
     * @param array $decoded
     *
     * @throws \Exception
     */
    protected function checkResponse(array $decoded)
    {
        if (empty($decoded)) {
            throw new \Exception("Could not parse response from server");
        }

        if (!empty($decoded["error"])) {
            $message = $decoded["error"]["message"];
            switch ($decoded["error"]["code"]) {
                case self::PARSE_ERROR:
                    throw new \Exception("Could not parse json request, message: $message");
                case self::INVALID_REQUEST:
                    throw new \Exception("Invalid request from client, message: $message");
                case self::METHOD_NOT_FOUND:
                    throw new \Exception("Method does not exist, message: $message");
                case self::INVALID_PARAMS:
                    throw new \Exception("Invalid method parameters, message: $message");
                case self::INTERNAL_ERROR:
                    throw new \Exception("Server error, message: $message");
                case self::USER_NOT_AUTHENTICATED:
                    throw new \Exception("Could not authenticate user, message: $message");
                default:
                    throw new \Exception("Unexpected error, message: $message");
            }
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
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->response->getStatusCode();
    }

}
