<?php
namespace ZeroConfig\D;

use Iterator;

interface RollIteratorInterface extends Iterator
{
    /**
     * Get the current roll.
     *
     * @return RollInterface
     */
    public function current(): RollInterface;
}
