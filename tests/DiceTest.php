<?php
namespace ZeroConfig\D\Tests;

use PHPUnit_Framework_TestCase;
use ZeroConfig\D\Dice;
use ZeroConfig\D\DieInterface;
use ZeroConfig\D\RollIteratorInterface;

/**
 * @coversDefaultClass \ZeroConfig\D\Dice
 */
class DiceTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return Dice
     *
     * @covers ::__construct
     */
    public function testConstructor(): Dice
    {
        return new Dice();
    }

    /**
     * @depends clone testConstructor
     *
     * @param Dice $dice
     *
     * @return void
     * @covers ::setModifier
     * @covers ::getModifier
     */
    public function testGetSetModifier(Dice $dice)
    {
        $dice->setModifier(1337);
        $this->assertEquals(1337, $dice->getModifier());

        $dice->setModifier(42);
        $this->assertEquals(42, $dice->getModifier());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|DieInterface
     */
    private function createDie(): DieInterface
    {
        return $this->createMock(DieInterface::class);
    }

    /**
     * @return RollIteratorInterface
     * @covers ::roll
     */
    public function testRoll(): RollIteratorInterface
    {
        $dice = new Dice(
            $this->createDie(),
            $this->createDie()
        );

        return $dice->roll();
    }

    /**
     * @return DieInterface
     * @covers ::current
     */
    public function testCurrent(): DieInterface
    {
        $dice = new Dice($this->createDie());

        return current(iterator_to_array($dice));
    }
}
