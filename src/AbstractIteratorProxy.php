<?php
namespace ZeroConfig\D;

use Iterator;

abstract class AbstractIteratorProxy implements Iterator
{
    /** @var Iterator */
    private $iterator;

    /**
     * Constructor.
     *
     * @param Iterator $iterator
     */
    public function __construct(Iterator $iterator)
    {
        $this->iterator = $iterator;
    }

    /**
     * @return void
     */
    public function next()
    {
        $this->getIterator()->next();
    }

    /**
     * @return int
     */
    public function key(): int
    {
        return $this->getIterator()->key();
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        return $this->getIterator()->valid();
    }

    /**
     * @return void
     */
    public function rewind()
    {
        $this->getIterator()->rewind();
    }

    /**
     * Get the internal iterator.
     *
     * @return Iterator
     */
    protected function getIterator(): Iterator
    {
        return $this->iterator;
    }
}
