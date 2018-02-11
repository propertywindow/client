<?php
declare(strict_types = 1);

namespace PropertyWindow;

use PropertyWindow\Properties\Property;
use PropertyWindow\Properties\PropertyMapper;
use PropertyWindow\SubTypes\SubType;
use PropertyWindow\SubTypes\SubTypeMapper;

/**
 * Class Client
 */
class Client extends Authentication
{
    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

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
        $body = $this->createBody($operation, $parameters);

        try {
            $this->response = $this->client->post($path, $body);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), 0, $ex);
        }

        $decoded = json_decode($this->response->getBody()->getContents(), true);

        $this->checkResponse($decoded);

        return array_key_exists('result', $decoded) ? $decoded["result"] : null;
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
     * @return Property[]
     * @throws \Exception
     */
    public function getProperties(): array
    {
        $response = $this->call('/property', 'getProperties');

        return PropertyMapper::toProperties($response);
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

    /**
     * @return SubType[]
     * @throws \Exception
     */
    public function getSubTypes(): array
    {
        $response = $this->call('/property/subtype', 'getSubTypes');

        return SubTypeMapper::toSubTypes($response);
    }
}
