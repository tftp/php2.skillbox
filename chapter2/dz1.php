<?php

class Animal
{
    public function walk()
    {

    }

    public function say()
    {

    }

}

class HoofAnimal extends Animal
{
    public function walk()
    {
        return " /топ-топ/ ";
    }
}

class FlyAnimal extends Animal
{
    public function walk()
    {
        return $this->tryToFly();
    }

    private function tryToFly()
    {
        echo " /Вжих-вжих-топ-топ/ ";
    }
}

class Cow extends HoofAnimal
{
    public function say()
    {
        return " /Мууууу/ ";
    }

}

class Pig extends HoofAnimal
{
    public function say()
    {
        return " /Хрю-хрю/ ";
    }

}

class Horse extends HoofAnimal
{
    public function say()
    {
        return " /Иго-го/ ";
    }
    //
    // public function walk()
    // {
    //     return " /Цок-цок-цок/ ";
    // }
}

class Chicken extends FlyAnimal
{
    public function say()
    {
        return " /Ко-ко-ко/ ";
    }
}

class Goose extends FlyAnimal
{
    public function say()
    {
        return " /Га-га-га/ ";
    }
}

class Turkey extends FlyAnimal
{
    public function say()
    {
        return " /Курлык-курлык/ ";
    }
}

class Farm
{
    protected $animals = [];

    public function addAnimal(Animal $animal)
    {
        $this->animals[] = $animal;
        echo $animal->walk();
    }

    public function rollCall()
    {
        $animals = $this->animals;
        shuffle($animals);
        foreach ($animals as $animal) {
            echo $animal->say();
        }
    }
}

class BirdFarm extends Farm
{
    public function addAnimal(Animal $animal)
    {
        parent::addAnimal($animal);
        $this->showAnimalsCount();
    }

    public function showAnimalsCount()
    {
        echo "Птиц на ферме: " . count($this->animals);
    }
}

class Farmer
{
    public function addAnimal(Farm $farm, Animal $animal)
    {
        $farm->addAnimal($animal);
    }

    public function rollCall(Farm $farm)
    {
        $farm->rollCall();
    }
}

$farmer = new Farmer;
$farm = new Farm();
$birdFarm = new BirdFarm();

$cow = new Cow();
$pig1 = new Pig();
$pig2 = new Pig();
$chicken = new Chicken();
$turkey1 = new Turkey();
$turkey2 = new Turkey();
$turkey3 = new Turkey();
$horse1 = new Horse();
$horse2 = new Horse();
$goose = new Goose();

$farmer->addAnimal($farm, $cow);
$farmer->addAnimal($farm, $pig1);
$farmer->addAnimal($farm, $pig2);
$farmer->addAnimal($farm, $horse1);
$farmer->addAnimal($farm, $horse2);
$farmer->addAnimal($birdFarm, $turkey1);
$farmer->addAnimal($birdFarm, $turkey2);
$farmer->addAnimal($birdFarm, $turkey3);
$farmer->addAnimal($birdFarm, $chicken);
$farmer->addAnimal($birdFarm, $goose);

$farmer->rollCall($farm);
$farmer->rollCall($birdFarm);
