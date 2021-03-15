<?php

class Box
{
    public function putBall(Ball $bal)
    {
        echo 'В корзину добавлен мяч. <br />';
    }

    public function getCountBalls()
    {
        echo ' Количество мячиков в корзине: ' . Ball::$count;
    }
}

class Ball
{
    public static $count = 0;

    public function __construct()
    {
        self::$count += 1;
    }
}


$box = new Box();
$defineCountBalls = rand(1, 100);
for ($i=0; $i < $defineCountBalls; $i++) {
    $box->putBall(new Ball());
}
$box->getCountBalls();
