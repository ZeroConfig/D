# Introduction

**D** is a dice rolling library. It allows for implementations of dice rolling
applications and logic.

See also [zero-config/d-roll](https://github.com/ZeroConfig/D-Roll),
an application implementing **D**.

# Installation

```bash
composer require zero-config/d:^2.0
```

# Entities

The library implements the following entities:

| Entity | Result                                  | Implements                              | Role                                                                         |
|:-------|:----------------------------------------|:----------------------------------------|:-----------------------------------------------------------------------------|
| `D`    | `RoleInterface`                         | `DieInterface`                          | Represents a single die.                                                     |
| `Roll` | `int`                                   | `RoleInterface`                         | Represents the outcome of a die roll.                                        |
| `Dice` | `RoleIteratorInterface`, `DieInterface` | `DiceInterface`, `DieIteratorInterface` | Represents multiple dice. It can roll for them at once or iterate over them. |

The entity that represents a die is called `D` because `die` is a reserved
keyword in the language and it matches with the shorthand name given to it by
players all over the world. 

# Services

The library implements the following services:

| Service        | Result          | Implements                 | Role                                     |
|:---------------|:----------------|:---------------------------|:-----------------------------------------|
| `Interpreter`  | `DiceInterface` | `DiceInterpreterInterface` | Interpret user input into a set of dice. |
| `RollIterator` | `RollInterface` | `RollIteratorInterface`    | Iterate over rolls.                      |

# Factories

The library implements the following factories:

| Factory          | Result                          | Implements                                    |
|:-----------------|:--------------------------------|:----------------------------------------------|
| `DieFactory`     | `DieInterface`, `DiceInterface` | `DieFactoryInterface`, `DiceFactoryInterface` |
| `RollFactory`    | `RollInterface`                 | `RollFactoryInterface`

# Number generator

The number generator comes from the
[hylianshield/number-generator](https://github.com/HylianShield/number-generator)
package by implementing its interface, the number generator can be swapped out.

# Use case

You may want to use a different number generator, because the default number
generator is not random enough to your taste. Let's see what is needed to create
an implementation with a custom number generator:

```php
<?php
use ZeroConfig\D\RollFactory;
use ZeroConfig\D\DieFactory;
use ZeroConfig\D\Interpreter;
use HylianShield\NumberGenerator\NumberGeneratorInterface;

/** @var NumberGeneratorInterface $myCustomNumberGenerator */
$interpreter = new Interpreter(
    new DieFactory(
        new RollFactory(),
        $myCustomNumberGenerator
    )    
);

$dice  = $interpreter->interpretDice('2d20+10');
$total = $dice->getModifier();

foreach ($dice->roll() as $roll) {
    $total += $roll->getValue();
}

echo $total;
```

This will result in a number between `11` and `50`.

One could make this a bit more verbose by iterating over the dice:

```php
<?php
/** @var \ZeroConfig\D\DiceInterface $dice */
foreach ($dice as $die) {
    echo sprintf(
        'd%d -> %d',
        $die->getNumberOfEyes(),
        $die->roll()->getValue()
    ) . PHP_EOL;
}
echo sprintf('+%d', $dice->getModifier());
```

This will output something like:

```
d20 -> 19
d20 -> 4
+10
```

# Complex interpretations.

If you want to interpret multiple dice configurations at once and also have them
grouped and sorted, the interpreter has an additional method, `interpretList`.

```php
<?php
/** ZeroConfig\D\DiceInterpreterInterface $interpreter */
$list = $interpreter->interpretList('3d6', 'D20', '4+10', '4+8', '1 d4');
```

The list will contain the following structure:

```
20 => Dice => Die x1 (+0),
6  => Dice => Die x3 (+0),
4  => Dice => Die x3 (+8)
```
