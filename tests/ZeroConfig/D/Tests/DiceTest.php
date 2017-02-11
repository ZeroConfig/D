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
