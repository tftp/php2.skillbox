<?php

class Calculator
{
    public static function calculate($number1, $number2, callable $callback)
    {
        return $callback($number1, $number2);
    }
}

class OperationHelper
{
    public static function multiplication($a, $b)
    {
        $c = $a * $b;
        return "$a * $b = $c" . PHP_EOL;
    }

    public function division($a, $b)
    {
        $c = $a / $b;
        return "$a / $b = $c" . PHP_EOL;
    }
}

$callbacks = [
    function($a, $b) {
        $c = $a + $b;
        return "$a + $b = $c" . PHP_EOL;
    },
    'subtraction',
    [OperationHelper::class, 'multiplication'],
    [new OperationHelper, 'division']
];

function subtraction($a, $b){
    $c = $a - $b;
    return "$a - $b = $c" . PHP_EOL;
}

echo '<pre>';

foreach ($callbacks as $callback) {
    echo Calculator::calculate(10, 5, $callback);
}

foreach ($callbacks as $callback) {
    echo Calculator::calculate(5, 10, $callback);
}

echo '</pre>';
