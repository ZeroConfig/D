<?php
namespace ZeroConfig\D;

interface RollFactoryInterface
{
    /**
     * Create a roll that holds a given value.
     *
     * @param int $value
     *
     * @return RollInterface
     */
    public function createRoll(int $value): RollInterface;
}
