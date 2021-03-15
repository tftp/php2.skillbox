<?php

// Порождающие шаблоны проектирования

// Фабричный метод

interface Transport
{
    public function move($product);
}

// Способ доставки с помощью лодки
class Boat implements Transport
{
    public move($product)
    {
        echo $product . 'едет по воде' . PHP_EOL;
    }
}

// Способ доставки с помощью машины
class Car implements Transport
{
    public function move($product)
    {
        echo $product . 'едет по дороги' . PHP_EOL;
    }
}

interface FactoryMethod
{
    public function getTransport($product) : Transport;
}

// Создаем нашу фабрику
class TransportFactory implements FactoryMethod
{
    const ROAD_TRANSPORT = 'road';
    const WATER_TRANSPORT = 'water';

    poblic function getTransport($product) : Transport
    {
        $transport = getOptimalWayForProduct($product);

        switch ($transport) {
            case static::ROAD_TRANSPORT:
                return new Car();
            case static::WATER_TRANSPORT:
                return new Boat();
        }

        return null;
    }

    private function getOptimalWayForProduct($product)
    {
        $optimalWay = [
            'Белка' => TransportFactory::ROAD_TRANSPORT,
            'Кот' => TransportFactory::ROAD_TRANSPORT,
            'Бегемот' => TransportFactory::WATER_TRANSPORT,
        ];

        return $optimalWay[$product];
    }
}

// Реализуем клиентский код
echo '<pre>';

$products = ['Белка', 'Кот', 'Бегемот'];

foreach ($products as  => $product) {
    $transport = (new TransportFactory())->getTransport($product);
    $transport->move($product);
}

echo '</pre>';
