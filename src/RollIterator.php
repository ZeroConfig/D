<?php
namespace ZeroConfig\D;

use ArrayIterator;

class RollIterator extends AbstractIteratorProxy implements RollIteratorInterface
{
    /**
     * Constructor.
     *
     * @param RollInterface[] ...$rolls
     */
    public function __construct(RollInterface ...$rolls)
    {
        parent::__construct(new ArrayIterator($rolls));
    }

    /**
     * Get the current roll.
     *
     * @return RollInterface
     */
    public function current(): RollInterface
    {
        return $this->getIterator()->current();
    }
}
