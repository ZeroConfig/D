<?php
namespace ZeroConfig\D;

use Iterator;

interface DieIteratorInterface extends Iterator
{
    /**
     * Get the current die.
     *
     * @return DieInterface
     */
    public function current(): DieInterface;
}
