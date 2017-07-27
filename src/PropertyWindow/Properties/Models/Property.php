<?php declare(strict_types=1);

namespace PropertyWindow\Properties\Models;

class Property
{
    /**
     * @var int
     */
    private $id;
    
    /**
     * @param int           $id
     */
    public function __construct(
        $id,
    ) {
        $this->id                 = $id;
    }
    
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
