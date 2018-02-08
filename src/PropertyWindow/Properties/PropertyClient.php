<?php
declare(strict_types = 1);

namespace PropertyWindow\Properties;

use PropertyWindow\Properties\Model\Property;

/**
 * Class PropertyClient
 */
class PropertyClient extends Client
{
    /**
     * @param int $id
     *
     * @return Property
     * @throws \Exception
     */
    public function getProperty($id): Property
    {
        $parameters = ['id' => $id];

        $response = $this->call('/property', 'getProperty', $parameters);

        return Mapper::toProperty($response);
    }
}
