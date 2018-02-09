<?php
declare(strict_types = 1);

namespace Tests\PropertyWindow\SubTypes;

use PHPUnit\Framework\TestCase;
use PropertyWindow\SubTypes\SubType;
use PropertyWindow\Types\Type;

/**
 *  SubType Test
 */
class SubTypeTest extends TestCase
{
    /**
     * @var SubType
     */
    private $subType;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->subType = new SubType();
    }

    public function testGetterAndSetter()
    {
        $this->assertNull($this->subType->getId());

        $type = new Type();

        $this->subType->setType($type);
        $this->assertEquals($type, $this->subType->getType());

        $this->subType->setSubType('Detached House');
        $this->assertEquals('Detached House', $this->subType->getSubType());
    }
}
