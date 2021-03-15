<?php

class Cat
{
    public $name;
    public $color;
    public $age;

    public function __construct($name, $color, $age)
    {
        $this->name = $name;
        $this->color = $color;
        $this->age = $age;
    }
}

class CatFactory
{
    public static function createBlack8YearsOldCat($name)
    {
        return new Cat($name, "black", 8);
    }

    public static function createYellow5YearsOldCat($name)
    {
        return new Cat($name, "yellow", 5);
    }

    public static function createGreen2YearsOldCat($name)
    {
        return new Cat($name, "green", 2);
    }

    public static function createGrey15YearsOldCat($name)
    {
        return new Cat($name, "grey", 15);
    }

    public static function createWhiteCat($name)
    {
        return new Cat($name, "white", 0);
    }

    public static function createBraunCat($name)
    {
        return new Cat($name, "braun", 0);
    }

    public static function create12YearsOldCat($name)
    {
        return new Cat($name, "???", 12);
    }
}

$cats = [
    CatFactory::createBlack8YearsOldCat("cat_R_01"),
    CatFactory::createYellow5YearsOldCat("cat_R_02"),
    CatFactory::createGreen2YearsOldCat("cat_R_03"),
    CatFactory::createGrey15YearsOldCat("cat_R_04"),
    CatFactory::createWhiteCat("cat_R_05"),
    CatFactory::createBraunCat("cat_R_06"),
    CatFactory::create12YearsOldCat("cat_R_07")
];

print_r($cats);
