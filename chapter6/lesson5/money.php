<?php

// Базовый паттерн.

// Шаблон Money - объект значений, содержит в себе как сумму так и валюту

final class Money
{
    private $amount; // сумма
    private $currency; // валюта

    public function __construct($amount, $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function isEqual(Money $money)
    {
        if ($this->getCurrency() === $money->getCurrency()) {
            return $this->getAmount() === $money->getAmount();
        } else {
            // здесь мывыполняем конвертацию и сравниваем
        }
    }
}

$money1 = new Money(1, '$');
$money2 = new Money(1, '$');

echo '<pre>';

echo ($money1 == $money2 ? 'Равны' : 'Не равны') . PHP_EOL;
echo ($money1->isEqual($money2) ? 'Равны' : 'Не равны') . PHP_EOL;

echo '</pre>';
