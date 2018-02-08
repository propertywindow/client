<?php
declare(strict_types = 1);

namespace PropertyWindow\SubTypes;

use PropertyWindow\Client;
use PropertyWindow\SubTypes\Model\SubType;

/**
 * Class SubTypeClient
 */
class SubTypeClient extends Client
{
    /**
     * @param int $id
     *
     * @return SubType
     * @throws \Exception
     */
    public function getSubType($id): SubType
    {
        $parameters = ['id' => $id];

        $response = $this->call('/property/subtype', 'getSubType', $parameters);

        return Mapper::toSubType($response);
    }
}
