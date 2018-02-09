<?php
declare(strict_types = 1);

namespace PropertyWindow\SubTypes;

use PropertyWindow\Types\Type;

/**
 * Class SubType
 */
class SubType
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Type
     */
    private $type;

    /**
     * @var string
     */
    private $subType;

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Type
     */
    public function getType(): Type
    {
        return $this->type;
    }

    /**
     * @param Type $type
     */
    public function setType(Type $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getSubType(): string
    {
        return $this->subType;
    }

    /**
     * @param string $SubType
     */
    public function setSubType(string $SubType): void
    {
        $this->subType = $SubType;
    }
}
