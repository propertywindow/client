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

        $terms = new Terms();
        $terms->setId($input['terms_id']);

        $property->setId($input['id']);
        $property->setSubType($subType);
        $property->setTerms($terms);
        $property->setStreet($input['street']);
        $property->setHouseNumber($input['house_number']);
        $property->setPostcode($input['postcode']);
        $property->setCity($input['city']);
        $property->setCountry($input['country']);
        $property->setPrice($input['price']);
        $property->setSoldPrice($input['sold_price']);
        $property->setEspc($input['espc']);
        $property->setLat($input['lat']);
        $property->setLng($input['lng']);
        $property->setArchived($input['archived']);

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