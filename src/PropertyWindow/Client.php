<?php
declare(strict_types=1);

namespace PropertyWindow\Properties;

use PropertyWindow\Models\Property;
use PropertyWindow\Property\Mapper;

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
     * @var string
     */
    private $uri;

    /**
     * @param string $uri
     * @param string $apiKey
     * @param string $apiSecret
     * @param int    $userId
     */
    public function __construct($uri, $apiKey, $apiSecret, $userId)
    {
        $this->client = new \GuzzleHttp\Client();

        $this->apiKey    = $apiKey;
        $this->apiSecret = $apiSecret;
        $this->userId    = $userId;
        $this->uri       = $uri;
    }

    /**
     * @param int $id
     *
     * @return Property
     * @throws \Exception
     */
    public function getProperty($id): Property
    {
        // todo: add property to own namespace and extend from client (function toProperty etc)

        $parameters = ['id' => $id];

        $response = $this->call('getProperty', $parameters);

        return Mapper::toProperty($response);
    }

    /**
     * @param string $operation
     * @param array  $parameters
     *
     * @return array|null
     * @throws \Exception
     */
    private function call($operation, array $parameters = [])
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

        $payloadEncoded = base64_encode($payloadJson);

        $body = json_encode(
            [
                "jsonrpc" => "2.0",
                "method"  => $operation,
                "params"  => $parameters,
            ]
        );

        if (empty($body)) {
            throw new \Exception("Could not encode request body");
        }

        //        $request = $this->client->post($this->uri,
        //            [
        //                'headers' => [
        //                    'Authorization' => 'Basic ' . $payloadEncoded,
        //                ],
        //            ],
        //            $body);


        $request = $this->client->request('POST', $this->uri, $body);


        try {
            $response = $this->client->send($request);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), 0, $ex);
        }

        $decoded = json_decode($response->getBody(), true);

        if ($decoded === null) {
            throw new \Exception("Could not parse response from server");
        }

        if (!empty($decoded["error"])) {
            $message = $decoded["error"]["message"];
            switch ($decoded["error"]["code"]) {
                case self::PARSE_ERROR: // Parse error
                    throw new \Exception("Could not parse json request, message: $message");
                case self::INVALID_REQUEST: // Invalid request
                    throw new \Exception("Invalid request from client, message: $message");
                case self::METHOD_NOT_FOUND: // Method not found
                    throw new \Exception("Method does not exist, message: $message");
                case self::INVALID_PARAMS: // Invalid params
                    throw new \Exception("Invalid method parameters, message: $message");
                case self::INTERNAL_ERROR: // Internal error
                    throw new \Exception("Server error, message: $message");
                case self::USER_NOT_AUTHENTICATED:
                    throw new \Exception("Could not authenticate user, message: $message");
                default:
                    throw new \Exception("Unexpected error, message: $message");
            }
        }

        return array_key_exists('result', $decoded) ? $decoded["result"] : null;
    }

}
