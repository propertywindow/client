<?php
declare(strict_types = 1);

namespace Tests\PropertyWindow\Types;

use PHPUnit\Framework\TestCase;
use PropertyWindow\Types\Type;

class TypeTest extends TestCase
{
    /**
     * @var Type
     */
    private $type;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->type = new Type();
    }

    public function testGetterAndSetter()
    {
        $this->assertNull($this->type->getId());

        $this->type->setName('House');
        $this->assertEquals('House', $this->type->getName());
    }
}
