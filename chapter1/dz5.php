<?php
include $_SERVER["DOCUMENT_ROOT"] . "/dz4.php";

class Order
{
    public $basket;

    public function __construct($basket)
    {
        $this->basket = $basket;
    }

    public function getBasket()     // возвращает корзину заказа
    {
        return $this->basket->describe();
    }

    public function getPrice()      // возвращает общую стоимость заказа
    {
        return $this->basket->getPrice();
    }
}

class Basket
{
    public $products = [];
    public $counts = [];

    public function addProduct($product, $count = 1)    // добавляет товар в корзину
    {

        $key = array_search($product, $this->products);
        if ($key) {
            $this->counts[$key] += $count;
        } else {
            array_push($this->products, $product);
            array_push($this->counts, $count);
        }
    }

    public function getPrice()      // возвращает стоимость товаров в корзине
    {
        $price = 0;
        foreach ($this->products as $key => $product) {
            $priceProduct = $product->getPrice();
            $countProduct = $this->counts[$key];
            $price += $priceProduct * $countProduct;
        }
        return $price;
    }

    public function describe()      // выводит или возвращает информацию о корзине в виде строки
    {
        $counts = $this->counts;
        $products = $this->products;
        $result = '';
        foreach ($products as $key => $product) {
            $result .= "<p> {$product->getName()} - {$product->getPrice()} руб. - $counts[$key] шт. </p>";
        }
        return $result;
        // return "<Наименование товара> — <Цена одной позиции> — <Количество>";
    }
}

class Product
{
    private $name;
    private $price;

    public function __construct($name, $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function getName()       // возвращает наименование товара
    {
        return $this->name;
    }

    public function getPrice()      // возвращает стоимость товара
    {
        return $this->price;
    }
}

// 2. Создать корзину, заполнить ее товарами. Создать заказ на основе этой корзины:
// $order = new Order($basket);

$product1 = new Product('Car', 1000);
$product2 = new Product('Barby', 900);
$product3 = new Product('Chelleng', 350);
$product4 = new Product('MS office', 1500);

$basket = new Basket();

$basket->addProduct($product1, 1);
$basket->addProduct($product2, 2);
$basket->addProduct($product3, 3);
$basket->addProduct($product4, 1);

$order = new Order($basket);

echo "<p>Корзина заказа</p>" . $order->getBasket();
echo "<p>Итого: " . $order->getPrice() . "</p>";

// Создать пользователя и отправить ему заказ

$user4 = new User("Николай Николаич", 'user1@localhost');
var_dump($user4->notify("для вас создан заказ, на сумму: {$order->getPrice()} руб. Состав: {$order->getBasket()}"));
