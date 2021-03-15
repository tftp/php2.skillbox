<?php
class ToyFactory
{
    public function createToy($name)
    {
        return new Toy($name, rand(5, 100));
    }
}

class Toy
{
    public $name;
    public $price;

    public function __construct($name, $price)
    {
        $this->name = $name;
        $this->price = $price;
    }
}

$toysName = ['Плюшевый мишка', 'Мячик', 'Машинка', 'Конструктор', 'Кукла Маша', 'Неваляшка'];
$toys = [];
$priceAll = 0;

for ($i=0; $i < rand(5, 15); $i++) {
    $name = $toysName[rand(0, count($toysName) - 1)];
    $toys[] = (new ToyFactory())->createToy($name);
}

foreach ($toys as $toy) {
    $priceAll += $toy->price;
    echo "<p> Название игрушки: $toy->name. Стоимость игрушки: $toy->price</p>";
}

echo "<p>Итого: $priceAll</p>";
