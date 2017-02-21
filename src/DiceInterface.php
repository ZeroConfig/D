<?php
namespace ZeroConfig\D;

interface DiceInterface extends DieIteratorInterface
{
    /**
     * Get the modifier for the current dice.
     *
     * @return int
     */
    public function getModifier(): int;

    /**
     * Get a list of rolls for the current dice.
     *
     * @return RollIteratorInterface
     */
    public function roll(): RollIteratorInterface;
}
