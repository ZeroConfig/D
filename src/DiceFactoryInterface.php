<?php
namespace ZeroConfig\D;

interface DiceFactoryInterface
{
    /**
     * Get dice for the given list of eyes.
     *
     * @param int[] ...$eyes
     *
     * @return DiceInterface
     */
    public function createDice(int ...$eyes): DiceInterface;
}
