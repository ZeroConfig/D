<?php
namespace ZeroConfig\D\Tests;

use ArrayIterator;
use Iterator;
use PHPUnit_Framework_TestCase;
use ZeroConfig\D\AbstractIteratorProxy;

/**
 * @coversDefaultClass \ZeroConfig\D\AbstractIteratorProxy
 */
class AbstractIteratorProxyTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|AbstractIteratorProxy
     *
     * @covers ::__construct
     */
    public function testConstructor()
    {
        return $this->getMockForAbstractClass(
            AbstractIteratorProxy::class,
            [$this->createMock(Iterator::class)]
        );
    }

    /**
     * @dataProvider iterationProvider
     *
     * @param array $expected
     *
     * @return void
     * @covers ::next
     * @covers ::key
     * @covers ::valid
     * @covers ::rewind
     * @covers ::getIterator
     */
    public function testIteration(array $expected)
    {
        /** @var AbstractIteratorProxy $iterator */
        $iterator = $this->getMockForAbstractClass(
            AbstractIteratorProxy::class,
            [new ArrayIterator($expected)]
        );

        $this->assertEquals($expected, iterator_to_array($iterator));
    }

    /**
     * @return array[][]
     */
    public function iterationProvider(): array
    {
        return [
            [
                [null],
                [null, null],
                [null, null, null]
            ]
        ];
    }
}
