<?php

// Структурные паттерны программирования - определяют как из классов и объектов образуются более сложные структуры

// Компоновщик - структурирует объекты. Предоставляет клиентскому коду общий интерфейс как для контейнера так и для одиночного элемента.

interface Renderable
{
    public function render() : string;
}

// Контейнер или группа
class RenderableGroup implements Renderable
{
    protected $elements = [];

    public function addElement(Renderable $element)
    {
        $this->elements = $element;
        return $this;
    }

    public function render() : string
    {
        $result = '';
        foreach ($this->elements as $element) {
            $result .= $element->render();
        }

        return $result;
    }
}

class Form extends RenderableGroup
{
    public function render() : string
    {
        return '<form>' . parrent::render() . '</form>';
    }
}

class DivGroup extends RenderableGroup
{
    public function render() : string
    {
        return '<div>' . parrent::render() . '</div>';
    }
}

// Одиночные объекты, элементы, листья в нашей иеррархии

class InputElement implements Renderable
{
    protected $type = 'text';

    public function render() : string
    {
        return '<input type="' . $this->type . '" />';
    }
}

class RadioInputElement extends InputElement
{
    protected $type = 'radio';
}

class FormButtonElement extends InputElement
{
    protected $type = 'submit';
}

// Клиентский код
echo (new Form())
    ->addElement(new InputElement())
    ->addElement(
        (new DivGroup())
            ->addElement(new RadioInputElement())
            ->addElement(new RadioInputElement())
    )
    ->addElement(new FormButtonElement())
    ->render()
;
