<?php

// Iterator - предоставляет способ последовательного доступа ко всем элементам составного объекта.

class Product
{
    public $name;
    public $price;

    public function __construct($name, $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function describe()
    {
        return $this->getName() . ': ' . number_format($this->getPrice(), 2, '.', '') . 'руб.';
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }
}

class Basket implements \Iterator
{
    private $products = [];
    private $currentIndex = 0;

    public function addProduct(Product $product)
    {
        $this->products[] = $product;
    }

    public function getPrice()
    {
        $this->rewind();
        $price = 0.0;

        foreach ($this as $product) {
            $price += $product->getPrice();
        }

        return $price;
    }

    public function current() : Product
    {
        return $this->products[$this->currentIndex];
    }

    public function key() : int
    {
        return $this->currentIndex;
    }

    public function next()
    {
        return $this->currentIndex++;
    }

    public function rewind()
    {
        return $this->currentIndex = 0;
    }

    public function valid() : bool
    {
        return isset($this->products[$this->currentIndex]);
    }
}

echo '<pre>';
$basket = new Basket();
$basket->addProduct(new Product('Коляска', 10000));
$basket->addProduct(new Product('Магнитик', 9.99));
$basket->addProduct(new Product('Машинка', 2000000));

foreach ($basket as $product) {
    echo $product->describe() . PHP_EOL;
}

echo 'Итого: ' .    $basket->getPrice() . PHP_EOL;
echo '</pre>';
