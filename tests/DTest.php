<?php
namespace ZeroConfig\D\Tests;

use HylianShield\NumberGenerator\NumberGeneratorInterface;
use PHPUnit_Framework_TestCase;
use ZeroConfig\D\D;
use ZeroConfig\D\RollFactoryInterface;
use ZeroConfig\D\RollInterface;

/**
 * @coversDefaultClass \ZeroConfig\D\D
 */
class DTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return D
     *
     * @covers ::__construct
     */
    public function testConstructor(): D
    {
        /** @noinspection PhpParamsInspection */
        return new D(
            6,
            $this->createMock(RollFactoryInterface::class),
            $this->createMock(NumberGeneratorInterface::class)
        );
    }

    /**
     * @return void
     * @covers ::__construct
     *
     * @expectedException        \DomainException
     * @expectedExceptionMessage The number of eyes on a die cannot be "1".
     */
    public function testInvalidNumberOfEyes()
    {
        /** @noinspection PhpParamsInspection */
        new D(
            1,
            $this->createMock(RollFactoryInterface::class),
            $this->createMock(NumberGeneratorInterface::class)
        );
    }

    /**
     * @depends testConstructor
     *
     * @param D $die
     *
     * @return int
     * @covers ::getNumberOfEyes
     */
    public function testGetNumberOfEyes(D $die): int
    {
        return $die->getNumberOfEyes();
    }

    /**
     * @depends testConstructor
     *
     * @param D $die
     *
     * @return RollInterface
     * @covers ::roll
     */
    public function testRoll(D $die): RollInterface
    {
        return $die->roll();
    }
}
