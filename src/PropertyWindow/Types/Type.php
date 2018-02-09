<?php
declare(strict_types = 1);

namespace PropertyWindow\Types;

/**
 * Class Type
 */
class Type
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $en;

    /**
     * @var string
     */
    private $nl;


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
    public function getEn(): string
    {
        return $this->en;
    }

    /**
     * @param string $en
     */
    public function setEn(string $en): void
    {
        $this->en = $en;
    }

    /**
     * @return string
     */
    public function getNl(): string
    {
        return $this->nl;
    }

    /**
     * @param string $nl
     */
    public function setNl(string $nl): void
    {
        $this->nl = $nl;
    }
}
