<?php

namespace PropertyWindow\Property;

use PropertyWindow\Property\Models\Exceptions\ResponseMappingException;
use PropertyWindow\Property\Models\Notification;


class Mapper
{
    /**
     * @param array $input
     *
     * @return Property
     */
    public static function toProperty(array $input)
    {
        return new Property(
            $input['id'],
            $input['street'],
            $input['house_number'],
        );
    }

    /**
     * @param array $input
     *
     * @return Property[]
     * @throws ResponseMappingException
     */
    public static function toProperties(array $input)
    {
        $result = array();

        foreach ($input as $in) {
            $result[] = self::toProperty($in);
        }

        return $result;
    }
}