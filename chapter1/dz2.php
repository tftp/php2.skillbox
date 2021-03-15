<?php

class HungryCat
{
    public $name;
    public $color;
    public $food;

    public function __construct($name, $color, $food)
    {
        $this->name = $name;
        $this->color = $color;
        $this->food = $food;
    }

    public function eat($food)
    {
        $result = "Голодный кот $this->name, особые приметы: цвет - $this->color, съел $food";
        $advanced = $this->food === $food ? " и замурчал 'мррррр' от своей любимой еды" : "";
        return $result . $advanced;
    }
}

$cat1 = new HungryCat('CatJon', 'red', 'meet');
$cat2 = new HungryCat('CatBoom', 'green', 'milk');

$foods = ['milk', 'chicken', 'bread', 'meat', 'whiskas'];

foreach ($foods as $food) {
    var_dump($cat1->eat($food));
    var_dump($cat2->eat($food));
}
