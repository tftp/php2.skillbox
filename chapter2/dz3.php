<?php

class Forg
{
    public function burn($object)
    {
        $flame = $object->burn();
        echo $flame->render((string)$object) . PHP_EOL;
    }
}

class BlueFlame
{
     public function render($name)
     {
         return $name . " сгорела в синем пламени";
     }
}

class RedFlame
{
     public function render($name)
     {
         return $name . " сгорела в красном пламени";
     }
}

class Smoke
{
     public function render($name)
     {
         return $name . " лишь задымилася";
     }
}

class Paper
{
    public function burn()
    {
        return new Smoke();
    }

    public function __toString()
    {
        return "Бумага";
    }
}

class Wood
{
    public function burn()
    {
        return new RedFlame();
    }

    public function __toString()
    {
        return "Деревяшка";
    }
}

class Game
{

        public function burn()
        {
            return new BlueFlame();
        }

        public function __toString()
        {
            return "Игра";
        }

}

class Kook
{
        public function burn()
        {
            return new RedFlame();
        }

        public function __toString()
        {
            return "Сумасшедшая";
        }

}

class Soul
{

        public function burn()
        {
            return new BlueFlame();
        }

        public function __toString()
        {
            return "Душа";
        }
    
}

$forg = new Forg();

$paper = new Paper();
$wood = new Wood();
$game = new Game();
$kook = new Kook();
$soul = new Soul();

$forg->burn($paper);
$forg->burn($wood);
$forg->burn($game);
$forg->burn($kook);
$forg->burn($soul);
