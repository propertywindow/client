<?php
declare(strict_types = 1);

namespace Tests\PropertyWindow\Properties;

use PHPUnit\Framework\TestCase;
use PropertyWindow\Properties\Property;
use PropertyWindow\SubTypes\SubType;
use PropertyWindow\Terms\Terms;

/**
 *  Property Test
 */
class PropertyTest extends TestCase
{
    /**
     * @var Property
     */
    private $property;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->property = new Property();
    }

    public function testAddress()
    {
        $this->property->setStreet('Street');
        $this->assertEquals('Street', $this->property->getStreet());

        $this->property->setHouseNumber('20');
        $this->assertEquals('20', $this->property->getHouseNumber());

        $this->property->setPostcode('postcode');
        $this->assertEquals('postcode', $this->property->getPostcode());

        $this->property->setCity('city');
        $this->assertEquals('city', $this->property->getCity());

        $this->property->setCountry('country');
        $this->assertEquals('country', $this->property->getCountry());
    }

    public function testMappings()
    {
        $this->assertNull($this->property->getId());

        $subType = new SubType();

        $this->property->setSubType($subType);
        $this->assertEquals($subType, $this->property->getSubType());

        $terms = new Terms();

        $this->property->setTerms($terms);
        $this->assertEquals($terms, $this->property->getTerms());
    }

    public function testGetterAndSetter()
    {
        $this->property->setPrice(150000);
        $this->assertEquals(150000, $this->property->getPrice());

        $this->property->setSoldPrice(0);
        $this->assertEquals(0, $this->property->getSoldPrice());

        $this->property->setEspc(false);
        $this->assertFalse($this->property->isEspc());

        $this->property->setLat('55.953252');
        $this->assertEquals('55.953252', $this->property->getLat());

        $this->property->setLng('-3.188267');
        $this->assertEquals('-3.188267', $this->property->getLng());

        $this->property->setOnline(false);
        $this->assertFalse($this->property->isOnline());

        $this->property->setArchived(true);
        $this->assertTrue($this->property->isArchived());
    }
}
