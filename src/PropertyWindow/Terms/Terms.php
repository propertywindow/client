<?php
declare(strict_types = 1);

namespace PropertyWindow\Terms;

/**
 * Class Terms
 */
class Terms
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $term;

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
    public function getTerm(): string
    {
        return $this->term;
    }

    /**
     * @param string $term
     */
    public function setTerm(string $term): void
    {
        $this->term = $term;
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
