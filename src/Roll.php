<?php
namespace ZeroConfig\D;

class Roll implements RollInterface
{
    /** @var int */
    private $value;

    /**
     * Constructor.
     *
     * @param int $value
     */
    public function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * Get the value of the roll.
     *
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }
}
