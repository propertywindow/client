<?php
declare(strict_types = 1);

namespace PropertyWindow\Types;

/**
 * Class TypeMapper
 */
class TypeMapper
{
    /**
     * @param array $input
     *
     * @return Type
     */
    public static function toType(array $input): Type
    {
        $type = new Type();

        $type->setId($input['id']);
        $type->setName($input['type']);

        return $type;
    }

    /**
     * @param array $input
     *
     * @return Type[]
     */
    public static function toTypes(array $input): array
    {
        $result = [];

        foreach ($input as $value) {
            $result[] = self::toType($value);
        }

        return $result;
    }
}