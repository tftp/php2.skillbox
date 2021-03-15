<?php

// Поведенческие шаблоны описывают варианты реализации того, как объекты взаимодействуют друг с другом.
// описывают  взаимодействие одних объектов с другими без жестких связей между ними

// Цепочка ответственности / Chain of responsibility

abstract class Handler
{
    private $next = null; //Handler или is_null

    public function link(Handler $next)
    {
        $this->next = $next;
        return $this->next;
    }

    public function handle($request)
    {
        if (!is_null($this->next)) {
            return $this->next->handle($request);
        }

        return false;
    }
}

class Operator extends Handler
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function handle($request)
    {
        if ($this->isBusy()) {
            echo 'Оператор ' . $this->name . 'занят' . PHP_EOL;

            return parent::handle($request);
        }

        echo 'Запрос ' . $request . ' принят оператором ' . $this->name . PHP_EOL;
    }

    private function isBusy()
    {
        return (bool)rand(0,4);
    }
}

class BusyHandler extends Handler
{
    private $request = null;

    public function handle($request)
    {
        if ($this->request == $request) {
            echo 'Все операторы заняты ' . PHP_EOL;
            return false;
        }

        $this->request = $request;

        if ($result = parent::handle($request)) {
            return $result;
        }
    }
}

$busyHandler = new BusyHandler();
$busyHandler
    ->link(new Operator('#1'))
    ->link(new Operator('#2'))
    ->link(new Operator('#3'))
    ->link($busyHandler);
echo '<pre>';
for ($i=0; $i < 3; $i++) {
    $result = $busyHandler->handle('request' . $i);
    if (!$result) {
        echo 'Запрос передан на уровень выше' . PHP_EOL;
    }
}
echo '</pre>';
