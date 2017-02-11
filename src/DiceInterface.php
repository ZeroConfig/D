<?php
namespace ZeroConfig\D;

interface DiceInterface extends DieIteratorInterface
{
    /**
     * Get a list of rolls for the current dice.
     *
     * @return RollIteratorInterface
     */
    public function roll(): RollIteratorInterface;
}
