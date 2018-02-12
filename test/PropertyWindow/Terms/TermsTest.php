<?php
declare(strict_types = 1);

namespace Tests\PropertyWindow\Types;

use PHPUnit\Framework\TestCase;
use PropertyWindow\Terms\Terms;

/**
 *  Terms Test
 */
class TermsTest extends TestCase
{
    /**
     * @var Terms
     */
    private $term;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->term = new Terms();
    }

    public function testGetterAndSetter()
    {
        $this->assertNull($this->term->getId());

        $this->term->setTerm('New');
        $this->assertEquals('New', $this->term->getTerm());

        $this->term->setShowPrice(true);
        $this->assertTrue($this->term->isShowPrice());
    }
}
