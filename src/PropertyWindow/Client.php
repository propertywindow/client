<?php
declare(strict_types = 1);

namespace PropertyWindow;

use PropertyWindow\Properties\Property;
use PropertyWindow\Properties\PropertyMapper;
use PropertyWindow\SubTypes\SubType;
use PropertyWindow\SubTypes\SubTypeMapper;
use PropertyWindow\Types\Type;
use PropertyWindow\Types\TypeMapper;

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
        $body           = $this->createBody($operation, $parameters);
        $this->response = $this->client->post($path, $body);
        $this->decoded  = json_decode($this->response->getBody()->getContents(), true);

        $this->checkResponse();

        return array_key_exists('result', $this->decoded) ? $this->decoded["result"] : null;
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

    /**
     * @param int $id
     *
     * @return Type
     * @throws \Exception
     */
    public function getType(int $id): Type
    {
        $parameters = ['id' => $id];
        $response   = $this->call('/property/type', 'getType', $parameters);

        return TypeMapper::toType($response);
    }

    /**
     * @return Type[]
     * @throws \Exception
     */
    public function getTypes(): array
    {
        $response = $this->call('/property/type', 'getTypes');

        return TypeMapper::toTypes($response);
    }
}
