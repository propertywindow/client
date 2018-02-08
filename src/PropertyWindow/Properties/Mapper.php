<?php
declare(strict_types = 1);

namespace PropertyWindow\Properties;

use PropertyWindow\Properties\Model\Property;

/**
 * Class Mapper
 */
class Mapper
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