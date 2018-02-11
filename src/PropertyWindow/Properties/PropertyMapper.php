<?php
declare(strict_types = 1);

namespace PropertyWindow\Properties;

/**
 * Class PropertyMapper
 */
class PropertyMapper
{
    /**
     * @param array $input
     *
     * @return Property
     */
    public static function toProperty(array $input): Property
    {
        $property = new Property();

        $property->setId($input['id']);
        $property->setStreet($input['street']);
        $property->setHouseNumber($input['house_number']);
        $property->setPostcode($input['postcode']);
        $property->setCity($input['city']);
        $property->setCountry($input['country']);

        return $property;
    }

    /**
     * @param array $input
     *
     * @return Property[]
     */
    public static function toProperties(array $input): array
    {
        $result = [];

        foreach ($input as $value) {
            $result[] = self::toProperty($value);
        }

        return $result;
    }
}