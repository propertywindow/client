<?php
declare(strict_types = 1);

namespace PropertyWindow\Terms;

class Terms
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var boolean
     */
    private $showPrice = false;

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

    /**
     * @return bool
     */
    public function isShowPrice(): bool
    {
        return $this->showPrice;
    }

    /**
     * @param bool $showPrice
     */
    public function setShowPrice(bool $showPrice): void
    {
        $this->showPrice = $showPrice;
    }
}
