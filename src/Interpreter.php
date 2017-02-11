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
     * '6' => [6]
     * '2d12' => [12, 12]
     * '2 d12' => [12, 12]
     * 'd20' => [20]
     *
     * @param string $diceConfiguration
     *
     * @return array
     */
    private function interpretDicePerEyes(string $diceConfiguration): array
    {
        $numDice = 1;
        $numEyes = 0;

        if (preg_match('/^(\d+)$/', $diceConfiguration, $matches)) {
            $numEyes = (int)next($matches);
        } elseif (preg_match(
            '/^(\d*)\s?d(\d+)$/i',
            $diceConfiguration,
            $matches
        )) {
            $numDice = (int)next($matches) ?: 1;
            $numEyes = (int)next($matches);
        }

        return array_fill(0, $numDice, $numEyes);
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
            $numEyes = current($list);

            if (!array_key_exists($numEyes, $dice)) {
                $dice[$numEyes] = [];
            }

            $dice[$numEyes] = array_merge($dice[$numEyes], $list);
        }

        // Make it so the dice with highest number of eyes start.
        krsort($dice, SORT_NUMERIC);

        return array_map(
            function (array $eyes) : DiceInterface {
                return $this->diceFactory->createDice(...$eyes);
            },
            $dice
        );
    }
}
