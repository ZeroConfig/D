<?php
namespace ZeroConfig\D\Tests;

use PHPUnit_Framework_TestCase;
use ZeroConfig\D\RollFactory;
use ZeroConfig\D\RollInterface;

/**
 * @coversDefaultClass \ZeroConfig\D\RollFactory
 */
class RollFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return RollInterface
     *
     * @covers ::createRoll
     */
    public function testConstructor(): RollInterface
    {
        $factory = new RollFactory();
        return $factory->createRoll(12);
    }
}
