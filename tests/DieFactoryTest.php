<?php
namespace ZeroConfig\D\Tests;

use HylianShield\NumberGenerator\NumberGeneratorInterface;
use PHPUnit_Framework_TestCase;
use ZeroConfig\D\DiceInterface;
use ZeroConfig\D\DieFactory;
use ZeroConfig\D\DieInterface;
use ZeroConfig\D\RollFactoryInterface;

/**
 * @coversDefaultClass \ZeroConfig\D\DieFactory
 */
class DieFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return DieFactory
     *
     * @covers ::__construct
     */
    public function testConstructor(): DieFactory
    {
        /** @noinspection PhpParamsInspection */
        return new DieFactory(
            $this->createMock(RollFactoryInterface::class),
            $this->createMock(NumberGeneratorInterface::class)
        );
    }

    /**
     * @depends testConstructor
     *
     * @param DieFactory $factory
     *
     * @return DieInterface
     * @covers ::createDie
     */
    public function testCreateDie(DieFactory $factory): DieInterface
    {
        return $factory->createDie(6);
    }

    /**
     * @depends testConstructor
     *
     * @param DieFactory $factory
     *
     * @return DiceInterface
     * @covers ::createDice
     */
    public function testCreateDice(DieFactory $factory): DiceInterface
    {
        $dice = $factory->createDice(6, 4, 2);

        $this->assertEquals(6, $dice->getModifier());
        $this->assertCount(2, $dice);

        return $dice;
    }
}
