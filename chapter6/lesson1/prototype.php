<?php

// Порождающие шаблоны проектирования

// Шаблон Прототип - задает виды создаваемых объектов с помощью экземпляра-прототипа и
// новые объекты создаютсяс помощью копирования исходного экземпляра
// Полезен когда стоимость создания объекта намного дороже чем стоимость клонирования

class Author
{
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }
}

abstract class BookPrototype
{
    protected $title;
    protected $category;
    public $author;

    abstract public function __clone();

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function setAuthor(Author $author)
    {
        $this->author = $author;
        return $this;
    }
}

class StoryBookPrototype extends BookPrototype
{
    protected $category = 'Повесть';

    public function __clone();
}

$storyBook = new StoryBookPrototype(); // это экземпляр прототипа

$book1 = clone $storyBook;
$book
    ->setAuthor(new Author('Пушкин'))
    ->setTitle('Пиковая дама')
;

print_r($book1);

// нельзя клонировать $book1 иначе его данные изменятся
