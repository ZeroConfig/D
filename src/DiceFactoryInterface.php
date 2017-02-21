<?php
namespace ZeroConfig\D;

interface DiceFactoryInterface
{
    /**
     * Get dice for the given list of eyes.
     *
     * @param int   $modifier
     * @param int[] ...$eyes
     *
     * @return DiceInterface
     */
    public function createDice(int $modifier, int ...$eyes): DiceInterface;
}
