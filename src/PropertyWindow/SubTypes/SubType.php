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
    private $name;

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
     * @return \PropertyWindow\Types\Type
     */
    public function getType(): Type
    {
        return $this->type;
    }

    /**
     * @param \PropertyWindow\Types\Type $type
     */
    public function setType(Type $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
