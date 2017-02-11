<?php
namespace ZeroConfig\D;

interface DiceInterpreterInterface
{
    /**
     * Interpret the given string into a set of dice.
     *
     * @param string $diceConfiguration
     *
     * @return DiceInterface
     */
    public function interpretDice(string $diceConfiguration): DiceInterface;

    /**
     * Interpret the given list of strings into a list of dice, keyed by
     * their number of eyes notation. E.g.: ['6' => Dice]
     *
     * @param string[] ...$diceConfigurations
     *
     * @return array|DiceInterface[]
     */
    public function interpretList(string ...$diceConfigurations): array;
}
