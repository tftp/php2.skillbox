<?php

interface Renderable
{
    public function render($string);
}

interface  Formatter
{
    public function format($string);
}

class AnyUseRender implements Renderable
{
    public function render($string)
    {
        echo 'To do render anything with ' . $string . '<br />';
    }
}

class AnyUseFormat implements Formatter
{
    public function format($string)
    {
        echo 'Doing anything format with ' . $string . '<br />';
    }
}

class Display
{
    public static function show($formatter, $string)
    {
        if ($formatter instanceof Renderable) {
            $formatter->render($string);
            return;
        }

        if ($formatter instanceof  Formatter) {
            $formatter->format($string);
            return;
        }

        if (method_exists($formatter, 'format')) {
            $formatter->format($string);
            return;
        }

        echo $string  . '<br />';
    }
}

class ClassWithFormat
{
    public function format($string)
    {
        echo 'It is format not from Formatter for ' . $string . '<br />';
    }
}

class ClassWithoutFormat
{
}

$objects = [new AnyUseRender(), new AnyUseFormat(), new ClassWithFormat(), new ClassWithoutFormat()];
$strings = ['Строка Один', 'Строка Два', 'Строка Три', 'Строка Четыре'];

foreach ($strings as $string) {
    foreach ($objects as $object) {
        Display::show($object, $string);
    }
}
