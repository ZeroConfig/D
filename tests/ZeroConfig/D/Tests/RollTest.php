<?php
namespace ZeroConfig\D\Tests;

use PHPUnit_Framework_TestCase;
use ZeroConfig\D\Roll;

/**
 * @coversDefaultClass \ZeroConfig\D\Roll
 */
class RollTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return Roll
     *
     * @covers ::__construct
     */
    public function testConstructor(): Roll
    {
        return new Roll(12);
    }

    /**
     * @depends testConstructor
     *
     * @param Roll $roll
     *
     * @return int
     * @covers ::getValue
     */
    public function testGetValue(Roll $roll): int
    {
        return $roll->getValue();
    }
}
