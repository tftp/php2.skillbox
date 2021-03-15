<?php

// Структурные паттерны программирования - определяют как из классов и объектов образуются более сложные структуры

// Декоратор - позволяет на лету назначать объекту новые обязаности

interface Booking
{
    public function calculatePrice() : int;
    public function getDiscription() : string;
}

abstract class BookingDecorator implements Booking
{
    protected $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }
}

// Должно быть что то базовое
class DoubleRoomBooking implements Booking
{
    public function calculatePrice() : int
    {
        return 40;
    }

    public function getDiscription() : string
    {
        return 'Номер на двоих';
    }
}

// Теперь сами декораторы
class WiFi extends BookingDecorator
{
    private const PRICE = 2;
    public function calculatePrice() : int
    {
        return $this->booking->calculatePrice() + self::PRICE;
    }

    public function getDiscription() : string
    {
        return $this->booking->getDiscription() . ', есть WiFi';
    }
}

class UnlimitedJuiceRefrigerator extends BookingDecorator
{
    private const PRICE = 100;
    public function calculatePrice() : int
    {
        return $this->booking->calculatePrice() + self::PRICE;
    }

    public function getDiscription() : string
    {
        return $this->booking->getDiscription() . ', есть безлимитный компот';
    }
}

// Клиентский код
$booking = new WiFi(new DoubleRoomBooking());
$booking1 = new WiFi(new UnlimitedJuiceRefrigerator(new DoubleRoomBooking()));
echo '<pre>';
echo $booking->getDiscription() . ' всего за ' . $booking->calculatePrice() . PHP_EOL;
echo $booking1->getDiscription() . ' всего за ' . $booking1->calculatePrice() . PHP_EOL;
echo '</pre>';
