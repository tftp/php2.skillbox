<?php

class Cat
{
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }
}

class Dog
{
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }
}

class Fish
{
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }
}

$animals[] = new Cat('CatJon');
$animals[] = new Cat('CatBoom');
$animals[] = new Cat('CatDoom');
$animals[] = new Dog('Dogerman');
$animals[] = new Dog('Dogermoon');
$animals[] = new Dog('Dogermas');
$animals[] = new Dog('Dogermaun');
$animals[] = new Dog('Dogarius');
$animals[] = new Fish('Fisher');


foreach ($animals as $animal) {
    var_dump($animal->name);
}
