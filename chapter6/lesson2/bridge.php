<?php

// Структурные паттерны программирования - определяют как из классов и объектов образуются более сложные структуры

// Мост - отделяет абстракцию от реализации чтоб то и другое можно было бы менять независимо друг от друга

/**
 *
 */
interface Formatter
{
    public function format($text) : string;
}

abstract class Service
{
    protected $formatter;

    public function __construct(Formatter $formatter)
    {
        $this->formatter = $formatter;
    }

    public setFormatter(Formatter $formatter)
    {
        $this->formatter = $formatter;
    }

    abstract public function get();
}

//Приступаем к р реализации

class HtmlFormatter implements Formatter
{
    public function format($text) : string
    {
        return '<h1>' . $text . '</h1>';
    }
}

class PlainTextFormatter implements Formatter
{
    public function format($text) : string
    {
        return $text;
    }
}

// Создаем Сервис
class HelloWorldService extends Service
{
    public function get()
    {
        return $this->formatter->format('Hello World');
    }
}

// Клиентская часть
$service = new HelloWorldService(new PlainTextFormatter());
echo $service->get() . PHP_EOL;

$service->setFormatter(new HtmlFormatter());
echo $service->get() . PHP_EOL;
