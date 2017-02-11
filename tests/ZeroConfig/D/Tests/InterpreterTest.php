<?php
namespace ZeroConfig\D\Tests;

use PHPUnit_Framework_TestCase;
use ZeroConfig\D\DiceFactoryInterface;
use ZeroConfig\D\DiceInterface;
use ZeroConfig\D\Interpreter;

/**
 * @coversDefaultClass \ZeroConfig\D\Interpreter
 */
class InterpreterTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|DiceFactoryInterface
     */
    private function createDiceFactory()
    {
        return $this->createMock(DiceFactoryInterface::class);
    }

    /**
     * @return Interpreter
     *
     * @covers ::__construct
     */
    public function testConstructor(): Interpreter
    {
        return new Interpreter($this->createDiceFactory());
    }

    /**
     * @depends testConstructor
     *
     * @param Interpreter $interpreter
     *
     * @return DiceInterface
     * @covers ::interpretDice
     * @covers ::interpretDicePerEyes
     */
    public function testInterpretDice(Interpreter $interpreter): DiceInterface
    {
        return $interpreter->interpretDice('2d20');
    }

    /**
     * @depends testConstructor
     *
     * @param Interpreter $interpreter
     *
     * @return DiceInterface[]
     * @covers ::interpretList
     * @covers ::interpretDicePerEyes
     */
    public function testInterpretList(Interpreter $interpreter): array
    {
        return $interpreter->interpretList('2d20', '100');
    }
}
