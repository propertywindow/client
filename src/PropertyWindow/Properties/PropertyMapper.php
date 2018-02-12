<?php
declare(strict_types = 1);

namespace PropertyWindow\Properties;

use PropertyWindow\SubTypes\SubType;
use PropertyWindow\Terms\Terms;

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

        $subType = new SubType();
        $subType->setId($input['subtype_id']);
        unset($input['subtype']);

        $terms = new Terms();
        $terms->setId($input['terms_id']);
        unset($input['terms']);

        $property->setSubType($subType);
        $property->setTerms($terms);

        self::prepareParameters($property, $input);

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

    /**
     * @param       $entity
     * @param array $input
     */
    public static function prepareParameters($entity, array $input)
    {
        foreach ($input as $property => $value) {
            $propertyPart = explode('_', $property);
            $property     = implode('', array_map('ucfirst', $propertyPart));
            $method       = sprintf('set%s', $property);

            if (is_callable([$entity, $method])) {
                $entity->$method($value);
            }
        }
    }
}