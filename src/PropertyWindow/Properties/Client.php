<?php declare(strict_types=1);

namespace PropertyWindow\Properties;

use Guzzle\Http\Client as GuzzleClient;

class Client
{
    /**
     * @var GuzzleClient
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
        $this->client = new GuzzleClient();

        $this->apiKey    = $apiKey;
        $this->apiSecret = $apiSecret;
        $this->userId    = $userId;
        $this->uri       = $uri;
    }
    
    /**
     * @param int $id
     *
     * @return Notification
     *
     * @throws Models\Exceptions\Exception
     * @throws CouldNotFindPropertyException
     */
    public function getProperty($id)
    {
        $parameters = array('id' => $id);

        $response = $this->call('getProperty', $parameters);

        return Mapper::toProperty($response);
    }
    
    /**
     * @param string $operation
     * @param array  $parameters
     *
     * @return array|null
     *
     * @throws PropertyException
     */
    private function call($operation, array $parameters = array())
    {
        $timestamp = time();
        $signature = hash_hmac("sha1", $timestamp . "-" . $this->userId, $this->apiSecret);

        $payload = array(
            "user"      => $this->userId,
            "api"       => $this->apiKey,
            "timestamp" => $timestamp,
            "signature" => $signature,
        );

        $payloadJson = json_encode($payload);
        if ($payloadJson === null) {
            throw new ClientException("Could not encode request headers");
        }

        $payloadEncoded = base64_encode($payloadJson);

        $id   = uniqid();
        $body = json_encode(
            array(
                "jsonrpc" => "2.0",
                "method"  => $operation,
                "params"  => $parameters,
                "id"      => $id,
            )
        );

        if ($body === null) {
            throw new ClientException("Could not encode request body");
        }

        $request = $this->client->post($this->uri, array("Authorization" => "Basic $payloadEncoded"), $body);

        try {
            $response = $this->client->send($request);
        } catch (Exception $ex) {
            throw new ServerException($ex->getMessage(), 0, $ex);
        }

        $decoded = json_decode($response->getBody(true), true);

        if ($decoded === null) {
            throw new ServerException("Could not parse response from server");
        }

        if (!empty($decoded["error"])) {
            $message = $decoded["error"]["message"];
            switch ($decoded["error"]["code"]) {
                case self::PARSE_ERROR: // Parse error
                    throw new ServerException("Could not parse json request, message: $message");
                case self::INVALID_REQUEST: // Invalid request
                    throw new ServerException("Invalid request from client, message: $message");
                case self::METHOD_NOT_FOUND: // Method not found
                    throw new ServerException("Method does not exist, message: $message");
                case self::INVALID_PARAMS: // Invalid params
                    throw new ServerException("Invalid method parameters, message: $message");
                case self::INTERNAL_ERROR: // Internal error
                    throw new ServerException("Server error, message: $message");
                case self::USER_NOT_AUTHENTICATED:
                    throw new ServerException("Could not authenticate user, message: $message");
                case self::NOTIFICATION_NOT_FOUND:
                    throw new CouldNotFindPropertyException();
                default:
                    throw new ServerException("Unexpected error, message: $message");
            }
        }

        if ($decoded["id"] !== $id) {
            throw new ServerException("Request and response identifiers don't match");
        }


        return array_key_exists('result', $decoded) ? $decoded["result"] : null;
    }

}
