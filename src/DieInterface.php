<?php
namespace ZeroConfig\D;

interface DieInterface
{
    /**
     * Get the number of eyes for the current die.
     *
     * @return int
     */
    public function getNumberOfEyes(): int;

    /**
     * Roll with the current die constraints.
     *
     * @return RollInterface
     */
    public function roll(): RollInterface;
}
