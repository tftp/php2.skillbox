<?php

// Базовый паттерн.

final class Point
{
    private $x, $y;

    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function getX()
    {
        return $this->x;
    }

    public function getY()
    {
        return $this->y;
    }

    public function isEqual(Point $point)
    {
        return $this->getX() == $point->getX() && $this->getY() == $point->getY();
    }
}

$point1 = new Point(1,2);
$point2 = new Point(1,2);

echo '<pre>';

echo ($point1 == $point2 ? 'Равны' : 'Не равны') . PHP_EOL;
echo ($point1->isEqual($point2) ? 'Равны' : 'Не равны') . PHP_EOL;

echo '</pre>';
