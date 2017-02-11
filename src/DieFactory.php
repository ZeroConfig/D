<?php
namespace ZeroConfig\D;

use HylianShield\NumberGenerator\NumberGeneratorInterface;

class DieFactory implements DieFactoryInterface, DiceFactoryInterface
{
    /** @var RollFactoryInterface */
    private $rollFactory;

    /** @var NumberGeneratorInterface */
    private $numberGenerator;

    /**
     * Constructor.
     *
     * @param RollFactoryInterface     $rollFactory
     * @param NumberGeneratorInterface $numberGenerator
     */
    public function __construct(
        RollFactoryInterface $rollFactory,
        NumberGeneratorInterface $numberGenerator
    ) {
        $this->rollFactory     = $rollFactory;
        $this->numberGenerator = $numberGenerator;
    }

    /**
     * Create a die for the given number of eyes.
     *
     * @param int $numEyes
     *
     * @return DieInterface
     */
    public function createDie(int $numEyes): DieInterface
    {
        return new D($numEyes, $this->rollFactory, $this->numberGenerator);
    }

    /**
     * Get dice for the given list of eyes.
     *
     * @param int[] ...$eyes
     *
     * @return DiceInterface
     */
    public function createDice(int ...$eyes): DiceInterface
    {
        return new Dice(
            ...array_map(
                function (int $numEyes) : DieInterface {
                    return $this->createDie($numEyes);
                },
                $eyes
            )
        );
    }
}
