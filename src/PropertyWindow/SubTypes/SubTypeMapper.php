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
        $subType = new SubType();

        $type = new Type();
        $type->setId($input['type_id']);

        $subType->setId($input['id']);
        $subType->setType($type);
        $subType->setName($input['subtype']);

        return $subType;
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