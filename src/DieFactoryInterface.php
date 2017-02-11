<?php
namespace ZeroConfig\D;

interface DieFactoryInterface
{
    /**
     * Create a die for the given number of eyes.
     *
     * @param int $numEyes
     *
     * @return DieInterface
     */
    public function createDie(int $numEyes): DieInterface;
}
