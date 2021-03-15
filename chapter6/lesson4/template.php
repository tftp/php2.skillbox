<?php

// Template method - Шаблонный метод - определяет основы алгоритма и позволяет по классам переопределять некоторые его шаги
// не изменяя структуры в целом.

abstract class Journey
{
    private $thingsToDo = [];

    final public function takeATrip()
    {
        $this->thingsToDo[] = $this->buyAFlight();
        $this->thingsToDo[] = $this->takePlane();
        $this->thingsToDo[] = $this->enjoyVacation();

        $buyGift = $this->buyGift();

        if ($buyGift !== null) {
            $this->thingsToDo[] = $buyGift;
        }

        $this->thingsToDo[] = $this->takePlane();
    }

    abstract protected function enjoyVacation() : string;

    protected function buyGift()
    {
        return null;
    }

    private function buyAFlight() : string
    {
        return 'Покупаем билеты на самолет';
    }

    private function takePlane() : string
    {
        return 'Летим на самолете';
    }

    public function getTingsToDo() : array
    {
        return $this->thingsToDo;
    }


}

class CityJourney extends Journey
{
    protected function enjoyVacation() : string
    {
        return 'Кушать, пить компот, спать до обеда и делать разные фото';
    }

    protected function buyGift() : string
    {
        return 'Купить магнитик';
    }
}

class BeachJourney extends Journey
{
    protected function enjoyVacation()
    {
        return 'Купаться на солнечном пляже';
    }
}

echo '<pre>';

$journey = rand(0,1) ? new BeachJourney() : new CityJourney;
$journey->takeATrip();

foreach ($journey->getTingsToDo as $item) {
    echo $item . PHP_EOL;  
}

echo '</pre>';
