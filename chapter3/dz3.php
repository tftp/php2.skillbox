<?php

abstract class Animal
{
    abstract public function move();
}

abstract class WaterAnimal extends Animal
{

}

abstract class EarthAnimal extends Animal
{

}

class Fish extends WaterAnimal
{
    public function move()
    {
        echo 'в воде влево-вправо-вверх-вниз';
    }
}

class Tiger extends EarthAnimal
{
    public function move()
    {
        echo "мягко ставит лапу";
    }
}

class Bear extends EarthAnimal
{
    public function move()
    {
        echo "шуршит в кустах малины";
    }
}

class Elk extends EarthAnimal
{
    public function move()
    {
        echo "идет напропалую";
    }
}

class Snake extends EarthAnimal
{
    public function move()
    {
        echo "ползет извиваясь между камнями";
    }
}

class Chicken extends EarthAnimal
{
    public function move()
    {
        echo "беспорядочно бегает";
    }
}

class Camel extends EarthAnimal
{
    public function move()
    {
        echo "важно шествует по пустыне";
    }
}

class Elephant extends EarthAnimal
{
    public function move()
    {
        echo "громко топает";
    }
}

class Dolphin extends WaterAnimal
{
    public function move()
    {
        echo "быстро плавает вверх вниз с ультразвуком";
    }
}
