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

}
