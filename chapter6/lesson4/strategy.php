<?php

// Startegy - Стратегия - определяет семейство алгоритмов, инкапсулирует каждый из них и делает их взаимозаменяемыми.

interface PaymentStrategy
{
    public function Pay($amount);
}

class Order
{
    private $amount; // стоимость заказа

    public function __construct($amount)
    {
        $this->amount = $amount;
    }

    public function pay(PaymentStrategy $strategy)
    {
        $strategy->pay($this->amount);
    }
}

class YandexMonyPayment implements PaymentStrategy
{
    public function pay($amount)
    {
        echo 'Оплата  через Яндекс Деньги, сумма к оплате: ' . $amount . PHP_EOL;
    }
}

class InnerAcountPayment implements PaymentStrategy
{
    public function pay($amount)
    {
        echo 'Списываем с внутреннего счета пользователя сумму: ' . $amount . PHP_EOL;
    }
}

echo '<pre>';
$order = new Order(100);
$order->pay(rand(0,1) ? new YandexMonyPayment() : new InnerAcountPayment());
echo '</pre>';
