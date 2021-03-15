<?php

abstract class Item
{
    protected $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function show()
    {
        echo 'Я ' . $this->name . ' <br />';
    }
}

class EmptyItem extends Item
{
    public function show()
    {
        echo 'Класс ' . $this->name . ' не найден <br />';
    }
}

class Creator
{
    public static function create($item)
    {
        if (class_exists($item)) {
            return new $item($item);
        } else {
            return new EmptyItem($item);
        }
    }
}

class Cat extends Item
{

}

class Dog extends Item
{

}

class Horse extends Item
{

}

class Man extends Item
{

}

$names = ['Baba', 'Dada', 'cat', 'Dog', 'Bob', 'horse', 'man', 'лопата', 'dot', 'clear'];

foreach ($names as $name) {
    $item = Creator::create($name);
    $item->show();
}
