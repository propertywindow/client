<?php
declare(strict_types = 1);

namespace Tests\PropertyWindow\Properties;

use PHPUnit\Framework\TestCase;
use PropertyWindow\Properties\Property;

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

    public function testGetterAndSetter()
    {
        $this->assertNull($this->property->getId());

        $this->property->setStreet('Street');
        $this->assertEquals('Street', $this->property->getStreet());

        $this->property->setHouseNumber('20');
        $this->assertEquals('20', $this->property->getHouseNumber());
    }
}
