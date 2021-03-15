<?php

abstract class Papers
{

}

abstract class Instrument
{

}

class Note extends Papers
{

}

class Book extends Papers
{

}

class Hammer extends Instrument
{

}

class Ball
{

}

class Manager
{
    public function place($item)
    {
        if ($item instanceof Papers) {
            return "Положил " . get_class($item) . " на стол  <br />";
        }

        if ($item instanceof Instrument) {
            return "Убрал " . get_class($item) . " внутрь стола  <br />";
        }

        return "Выкинул " . (is_object($item) ? get_class($item) : $item) . " в корзину  <br />";
    }
}

$note = new Note();
$hammer = new Hammer();
$foo = 'Bober';
$ball = new Ball();
$book = new Book();

$manager = new Manager();

echo $manager->place($note);
echo $manager->place($hammer);
echo $manager->place($foo);
echo $manager->place($ball);
echo $manager->place($book);
