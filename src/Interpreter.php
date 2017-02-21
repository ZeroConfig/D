<?php
namespace ZeroConfig\D;

class Interpreter implements DiceInterpreterInterface
{
    /**
     * @var DiceFactoryInterface
     */
    private $diceFactory;

    /**
     * Constructor.
     *
     * @param DiceFactoryInterface $diceFactory
     */
    public function __construct(DiceFactoryInterface $diceFactory)
    {
        $this->diceFactory = $diceFactory;
    }

    /**
     * Interpret the given string into a dice configuration list.
     *
     * E.g.:
     *
     * '6' => [0, 6]
     * '2d12' => [0, 12, 12]
     * '2 d12' => [0, 12, 12]
     * 'd20+10' => [10, 20]
     *
     * @param string $diceConfiguration
     *
     * @return array
     */
    private function interpretDicePerEyes(string $diceConfiguration): array
    {
        $numDice  = 1;
        $numEyes  = 0;
        $modifier = 0;

        if (preg_match(
            '/^(\d*?)\s?d?(\d+)(\s?\+(\d+))?$/i',
            trim($diceConfiguration),
            $matches
        )) {
            $numDice = (int)next($matches) ?: 1;
            $numEyes = (int)next($matches);
            next($matches);
            $modifier = (int)next($matches);
        }

        return [$modifier] + array_fill(1, $numDice, $numEyes);
    }

    /**
     * Interpret the given string into a set of dice.
     *
     * @param string $diceConfiguration
     *
     * @return DiceInterface
     */
    public function interpretDice(string $diceConfiguration): DiceInterface
    {
        return $this->diceFactory->createDice(
            ...$this->interpretDicePerEyes($diceConfiguration)
        );
    }

    /**
     * Interpret the given list of strings into a list of dice, keyed by
     * their number of eyes notation. E.g.: [6 => Dice]
     *
     * @param string[] ...$diceConfigurations
     *
     * @return array|DiceInterface[]
     */
    public function interpretList(string ...$diceConfigurations): array
    {
        $dice = [];

        foreach ($diceConfigurations as $config) {
            $list    = $this->interpretDicePerEyes($config);
            $numEyes = next($list);

            if (!array_key_exists($numEyes, $dice)) {
                $dice[$numEyes] = [];
            }

            $dice[$numEyes][] = $list;
        }

        // Make it so the dice with highest number of eyes start.
        krsort($dice, SORT_NUMERIC);

        return array_map(
            function (array $configurations) : DiceInterface {
                $eyes     = [];
                $modifier = 0;

                foreach ($configurations as $configuration) {
                    $modCheck = array_shift($configuration);

                    if ($modCheck > 0) {
                        $modifier = $modCheck;
                    }

                    $eyes = array_merge($eyes, $configuration);
                }

                return $this->diceFactory->createDice($modifier, ...$eyes);
            },
            $dice
        );
    }
}
