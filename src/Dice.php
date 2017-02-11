<?php
namespace ZeroConfig\D;

use ArrayIterator;

class Dice extends AbstractIteratorProxy implements DiceInterface
{
    /**
     * Constructor.
     *
     * @param DieInterface[] ...$dice
     */
    public function __construct(DieInterface ...$dice)
    {
        parent::__construct(new ArrayIterator($dice));
    }

    /**
     * Get a list of rolls for the current dice.
     *
     * @return RollIteratorInterface
     */
    public function roll(): RollIteratorInterface
    {
        return new RollIterator(
            ...array_map(
                function (DieInterface $die) : RollInterface {
                    return $die->roll();
                },
                iterator_to_array($this)
            )
        );
    }

    /**
     * Get the current die.
     *
     * @return DieInterface
     */
    public function current(): DieInterface
    {
        return $this->getIterator()->current();
    }
}
