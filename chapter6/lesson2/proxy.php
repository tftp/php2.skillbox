<?php

// Структурные паттерны программирования - определяют как из классов и объектов образуются более сложные структуры

// Прокси - позволяет заместитть обращение к объекту через себя

//Сначала создадим базовый класс который будем оборачивать в прокси
interface Ballance
{
    public function getBallance();
}

class BankAccaunt implements Ballance
{
    public function getBallance
    {
        sleep(2); //иммитируем запрос к серверу
        return 100;
    }
}

// зададим прокси
class BankAccauntProxy extends BankAccaunt implements Balance
{
    protected $balance;

    public function getBallance()
    {
        if (!is_null($this->balance)) {
            return $this->balance;
        }

        return $this->balance = parent::getBallance();
    }
}
