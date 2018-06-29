<?php
declare(strict_types = 1);

namespace PropertyWindow;

use PropertyWindow\Properties\Property;
use PropertyWindow\Properties\PropertyMapper;
use PropertyWindow\SubTypes\SubType;
use PropertyWindow\SubTypes\SubTypeMapper;
use PropertyWindow\Terms\Terms;
use PropertyWindow\Terms\TermsMapper;
use PropertyWindow\Types\Type;
use PropertyWindow\Types\TypeMapper;

class Client extends Connection
{
    /**
     * @param int $id
     *
     * @return Property
     * @throws \Exception
     */
    public function getProperty(int $id): Property
    {
        $parameters = [
            'id'       => $id,
            'ip'       => '192.169.0.1',
            'browser'  => 'none',
            'location' => 'none',
            'referrer' => '',
        ];

        $response = $this->call('/property', 'getProperty', $parameters);

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
     * @return Terms
     * @throws \Exception
     */
    public function getTerm(int $id): Terms
    {
        $parameters = ['id' => $id];
        $response   = $this->call('/property/terms', 'getTerm', $parameters);

        return TermsMapper::toTerm($response);
    }

    /**
     * @return Terms[]
     * @throws \Exception
     */
    public function getTerms(): array
    {
        $response = $this->call('/property/terms', 'getTerms');

        return TermsMapper::toTerms($response);
    }
}
