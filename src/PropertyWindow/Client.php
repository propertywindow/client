<?php
declare(strict_types = 1);

namespace PropertyWindow;

use GuzzleHttp\Psr7\Response;
use PropertyWindow\Properties\Property;
use PropertyWindow\Properties\PropertyMapper;
use PropertyWindow\SubTypes\SubType;
use PropertyWindow\SubTypes\SubTypeMapper;


/**
 * Class Client
 */
class Client
{
    public const PARSE_ERROR            = -32700;
    public const INVALID_REQUEST        = -32600;
    public const METHOD_NOT_FOUND       = -32601;
    public const INVALID_PARAMS         = -32602;
    public const INTERNAL_ERROR         = -32603;
    public const EXCEPTION_ERROR        = -32604;
    public const USER_NOT_AUTHENTICATED = -32000;

    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var string
     */
    private $apiSecret;

    /**
     * @var int
     */
    private $userId;

    /**
     * @var Response
     */
    private $response;

    /**
     * @param string $username
     * @param string $password
     * @param int    $userId
     *
     * @throws \Exception
     */
    public function __construct(string $username, string $password, int $userId)
    {
        $this->apiKey    = $username;
        $this->apiSecret = $password;
        $this->userId    = $userId;

        $token = json_encode($this->generateToken());

        $this->client = new \GuzzleHttp\Client([
            'base_uri' => 'https://engine.propertywindow.nl',
            'headers'  => [
                'Accept'        => 'application/json',
                'Authorization' => 'Authorization ' . $token,
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
        $body = [
            "jsonrpc" => "2.0",
            "method"  => $operation,
            "params"  => $parameters,
        ];

        if (empty($body)) {
            throw new \Exception("Could not encode request body");
        }

        $request = $this->client->request('POST', $path, $body);

        try {
            $this->response = $this->client->send($request);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), 0, $ex);
        }

        $decoded = json_decode($this->response->getBody(), true);

        $this->checkResponse($decoded);

        return array_key_exists('result', $decoded) ? $decoded["result"] : null;
    }

    /**
     * @return string
     * @throws \Exception
     */
    private function generateToken(): string
    {
        $timestamp = time();
        $signature = hash_hmac("sha1", $timestamp . "-" . $this->userId, $this->apiSecret);

        $payload = [
            "user"      => $this->userId,
            "api"       => $this->apiKey,
            "timestamp" => $timestamp,
            "signature" => $signature,
        ];

        $payloadJson = json_encode($payload);
        if (empty($payloadJson)) {
            throw new \Exception("Could not encode request headers");
        }

        return base64_encode($payloadJson);
    }

    /**
     * @param array $decoded
     *
     * @throws \Exception
     */
    private function checkResponse(array $decoded)
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
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->response->getStatusCode();
    }

    /**
     * @param int $id
     *
     * @return Property
     * @throws \Exception
     */
    public function getProperty(int $id): Property
    {
        $parameters = ['id' => $id];
        $response   = $this->call('/property', 'getProperty', $parameters);

        return PropertyMapper::toProperty($response);
    }

    /**
     * @param int $id
     *
     * @return SubType
     * @throws \Exception
     */
    public function getSubType(int $id): SubType
    {
        $parameters = ['id' => $id];
        $response   = $this->call('/property/subtype', 'getSubType', $parameters);

        return SubTypeMapper::toSubType($response);
    }
}
