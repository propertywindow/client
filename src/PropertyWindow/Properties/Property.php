<?php
declare(strict_types = 1);

namespace PropertyWindow\Properties;

use PropertyWindow\SubTypes\SubType;
use PropertyWindow\Terms\Terms;

/**
 * Class Property
 */
class Property
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var \PropertyWindow\SubTypes\SubType
     */
    private $subType;

    /**
     * @var \PropertyWindow\Terms\Terms
     */
    private $terms;

    /**
     * @var string
     */
    private $street;

    /**
     * @var string
     */
    private $houseNumber;

    /**
     * @var string
     */
    private $postcode;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $country;

    /**
     * @var int
     */
    private $price = 0;

    /**
     * @var int|null
     */
    private $soldPrice;

    /**
     * @var bool
     */
    private $espc = false;

    /**
     * @var string
     */
    private $lat;

    /**
     * @var string
     */
    private $lng;

    /**
     * @var bool
     */
    private $online = false;

    /**
     * @var bool
     */
    private $archived = false;

    /**
     * @param int $id
     */
    public function setId(int $id): void
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
     * @return \PropertyWindow\SubTypes\SubType
     */
    public function getSubType(): SubType
    {
        return $this->subType;
    }

    /**
     * @param \PropertyWindow\SubTypes\SubType $subType
     */
    public function setSubType(SubType $subType): void
    {
        $this->subType = $subType;
    }

    /**
     * @return \PropertyWindow\Terms\Terms
     */
    public function getTerms(): Terms
    {
        return $this->terms;
    }

    /**
     * @param \PropertyWindow\Terms\Terms $terms
     */
    public function setTerms(Terms $terms): void
    {
        $this->terms = $terms;
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @param string $street
     */
    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    /**
     * @return string
     */
    public function getHouseNumber(): string
    {
        return $this->houseNumber;
    }

    /**
     * @param string $houseNumber
     */
    public function setHouseNumber(string $houseNumber): void
    {
        $this->houseNumber = $houseNumber;
    }

    /**
     * @return string
     */
    public function getPostcode(): string
    {
        return $this->postcode;
    }

    /**
     * @param string $postcode
     */
    public function setPostcode(string $postcode): void
    {
        $this->postcode = $postcode;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    /**
     * @return int|null
     */
    public function getSoldPrice(): ?int
    {
        return $this->soldPrice;
    }

    /**
     * @param int|null $soldPrice
     */
    public function setSoldPrice(?int $soldPrice): void
    {
        $this->soldPrice = $soldPrice;
    }

    /**
     * @return bool
     */
    public function isEspc(): bool
    {
        return $this->espc;
    }

    /**
     * @param bool $espc
     */
    public function setEspc(bool $espc): void
    {
        $this->espc = $espc;
    }

    /**
     * @return string
     */
    public function getLat(): string
    {
        return $this->lat;
    }

    /**
     * @param string $lat
     */
    public function setLat(string $lat): void
    {
        $this->lat = $lat;
    }

    /**
     * @return string
     */
    public function getLng(): string
    {
        return $this->lng;
    }

    /**
     * @param string $lng
     */
    public function setLng(string $lng): void
    {
        $this->lng = $lng;
    }

    /**
     * @return bool
     */
    public function isOnline(): bool
    {
        return $this->online;
    }

    /**
     * @param bool $online
     */
    public function setOnline(bool $online): void
    {
        $this->online = $online;
    }

    /**
     * @return bool
     */
    public function isArchived(): bool
    {
        return $this->archived;
    }

    /**
     * @param bool $archived
     */
    public function setArchived(bool $archived): void
    {
        $this->archived = $archived;
    }
}
