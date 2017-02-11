<?php
namespace ZeroConfig\D;

class RollFactory implements RollFactoryInterface
{
    /**
     * Create a roll that holds a given value.
     *
     * @param int $value
     *
     * @return RollInterface
     */
    public function createRoll(int $value): RollInterface
    {
        return new Roll($value);
    }
}
