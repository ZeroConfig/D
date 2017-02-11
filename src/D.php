<?php
namespace ZeroConfig\D;

use DomainException;
use HylianShield\NumberGenerator\NumberGeneratorInterface;

class D implements DieInterface
{
    /** @var int */
    private $numEyes;

    /** @var RollFactoryInterface */
    private $rollFactory;

    /** @var NumberGeneratorInterface */
    private $numberGenerator;

    /**
     * Constructor.
     *
     * @param int                      $numEyes
     * @param RollFactoryInterface     $rollFactory
     * @param NumberGeneratorInterface $numberGenerator
     *
     * @throws DomainException When the given number of eyes is less than 2.
     */
    public function __construct(
        $numEyes,
        RollFactoryInterface $rollFactory,
        NumberGeneratorInterface $numberGenerator
    ) {
        if ($numEyes < 2) {
            throw new DomainException(
                sprintf('The number of eyes on a die cannot be "%d".', $numEyes)
            );
        }

        $this->numEyes         = $numEyes;
        $this->rollFactory     = $rollFactory;
        $this->numberGenerator = $numberGenerator;
    }

    /**
     * Get the number of eyes for the current die.
     *
     * @return int
     */
    public function getNumberOfEyes(): int
    {
        return $this->numEyes;
    }

    /**
     * Roll with the current die constraints.
     *
     * @return RollInterface
     */
    public function roll(): RollInterface
    {
        return $this->rollFactory->createRoll(
            $this->numberGenerator->generateNumber(1, $this->numEyes)
        );
    }
}
