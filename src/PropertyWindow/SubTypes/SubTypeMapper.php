<?php
declare(strict_types = 1);

namespace PropertyWindow\SubTypes;

use PropertyWindow\Types\Type;

/**
 * Class SubTypeMapper
 */
class SubTypeMapper
{
    /**
     * @param array $input
     *
     * @return SubType
     */
    public static function toSubType(array $input): SubType
    {
        $property = new SubType();

        $type = new Type();
        $type->setId($input['type_id']);

        $property->setId($input['id']);
        $property->setType($type);
        $property->setSubType($input['subtype']);

        return $property;
    }

    /**
     * @param array $input
     *
     * @return SubType[]
     */
    public static function toSubTypes(array $input): array
    {
        $result = [];

        foreach ($input as $value) {
            $result[] = self::toSubType($value);
        }

        return $result;
    }
}