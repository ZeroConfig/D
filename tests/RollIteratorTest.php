<?php
namespace ZeroConfig\D\Tests;

use PHPUnit_Framework_TestCase;
use ZeroConfig\D\RollInterface;
use ZeroConfig\D\RollIterator;

/**
 * @coversDefaultClass \ZeroConfig\D\RollIterator
 */
class RollIteratorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return RollIterator
     *
     * @covers ::__construct
     */
    public function testConstructor(): RollIterator
    {
        return new RollIterator();
    }

    /**
     * @return RollInterface
     * @covers ::current
     */
    public function testCurrent(): RollInterface
    {
        /** @var RollInterface $roll */
        $roll     = $this->createMock(RollInterface::class);
        $iterator = new RollIterator($roll);

        return current(
            iterator_to_array($iterator)
        );
    }
}
