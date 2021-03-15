<?php

class BlackBox
{
    private $data = [];

    public function addLog($message)
    {
        $this->data[] = $message;
    }

    public function getDataByEngineer()
    {
        return $this->data;
    }
}

class Plane
{
    private $blackBox;

    public function __construct()
    {
        $this->blackBox = new BlackBox();
    }

    public function flyAndCrush()
    {
        $this->flyProcess();
        $this->crushProcess();
    }

    protected function flyProcess()
    {
        $messages = [
                "Разбег прошел успешно. Отрыв. <br />",
                "Высота 100 метров <br />",
                "Высота 500 метров <br />",
                "Высота 2000 метров <br />",
                "Высота 5000 метров <br />",
                "Высота 10000 метров <br />",
                "Высота 5000 метров <br />",
                "Высота 2000 метров <br />",
                "Заход на посадку <br />"
        ];

        for ($i=0; $i < rand(1, count($messages)); $i++) {
            $this->addLog($messages[$i]);
        }
    }

    protected function crushProcess()
    {
        $message = "Отказ и разрушение правого двигателя. <br />";
        $this->addLog($message);
    }

    protected function addLog($message)
    {
        $this->blackBox->addLog($message);
    }

    public function getBoxForEngineer(Engineer $engineer)
    {
        $engineer->setBox($this->blackBox);
    }
}

class WariorPlane extends Plane
{

}

class Engineer
{
    private $blackBox;

    public function setBox(BlackBox $blackBox)
    {
        $this->blackBox = $blackBox;
    }

    public function takeBox(Plane $plane)
    {
        $plane->getBoxForEngineer($this);
    }

    public function decodeBox()
    {
        $messages = $this->blackBox->getDataByEngineer();
        foreach ($messages as $message) {
            echo $message;
        }
    }
}

$plane = new Plane();
$plane->flyAndCrush();

$engineer = new Engineer();
$engineer->takeBox($plane);
$engineer->decodeBox();

$planeWarior = new WariorPlane();
$planeWarior->flyAndCrush();

$engineer->takeBox($planeWarior);
$engineer->decodeBox();
