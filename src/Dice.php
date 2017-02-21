<?php
namespace ZeroConfig\D;

use ArrayIterator;

class Dice extends AbstractIteratorProxy implements DiceInterface
{
    /** @var int */
    private $modifier = 0;

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

    /**
     * Get the modifier for the current dice.
     *
     * @return int
     */
    public function getModifier(): int
    {
        return $this->modifier;
    }

    /**
     * Set the modifier for the current dice.
     *
     * @param int $modifier
     *
     * @return void
     */
    public function setModifier(int $modifier)
    {
        $this->modifier = $modifier;
    }
}
