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
     * @return string[][]|int[][]
     */
    public function diceConfigurationProvider(): array
    {
        return [
            ['3d20+12', 12, 20, 20, 20],
            ['6 D8 +6', 6, 8, 8, 8, 8, 8, 8],
            ['D4', 0, 4],
            ['12+10', 10, 12],
            ['1337', 0, 1337]
        ];
    }

    /**
     * @dataProvider diceConfigurationProvider
     *
     * @param string $configuration
     * @param \int[] $expected
     *
     * @return DiceInterface
     * @covers ::interpretDice
     * @covers ::interpretDicePerEyes
     */
    public function testInterpretDice(
        string $configuration,
        int ...$expected
    ): DiceInterface {
        $factory     = $this->createDiceFactory();
        $interpreter = new Interpreter($factory);

        $factory
            ->expects($this->once())
            ->method('createDice')
            ->with(...$expected)
            ->willReturn($this->createMock(DiceInterface::class));

        return $interpreter->interpretDice($configuration);
    }

    /**
     * @return string[][][]|int[][][][]
     */
    public function diceConfigurationListProvider(): array
    {
        return [
            [
                ['3', '2d20+8', 'd20+10', 'd20', '4'],
                [[10, 20, 20, 20, 20], [0, 4], [0, 3]]
            ],
            [
                ['3D6+10', 'D10'],
                [[0, 10], [10, 6, 6, 6]]
            ],
        ];
    }

    /**
     * @dataProvider diceConfigurationListProvider
     *
     * @param array $list
     * @param array $expected
     *
     * @return DiceInterface[]
     * @covers ::interpretList
     * @covers ::interpretDicePerEyes
     */
    public function testInterpretList(array $list, array $expected): array
    {
        $factory     = $this->createDiceFactory();
        $interpreter = new Interpreter($factory);

        $factory
            ->expects($this->exactly(count($expected)))
            ->method('createDice')
            ->withConsecutive(...$expected)
            ->willReturn($this->createMock(DiceInterface::class));

        return $interpreter->interpretList(...$list);
    }
}
