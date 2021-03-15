<?php

// Структурные паттерны программирования - определяют как из классов и объектов образуются более сложные структуры

// Фасад - унифицирует интерфейс вместо набора интерфейсов некоторой подсистемы, упрощает использование подсистемы.

interface OsInterface
{
    public function halt();
    public function getName() : string;
}

interface BiosInterface
{
    public function execute();
    public function waitForKeyPress();
    public function launch(OsInterface $os);
    public function powerDown();
}

//создаем фасад для удобства работы с двумя интерфейсами
class Facade
{
    private $os;
    private $bios;

    public function __construct(BiosInterface $bios, OsInterface $os)
    {
        $this->bios = $bios;
        $this->os = $os;
    }

    public function turnOn()
    {
        $this->bios->execute();
        $this->bios->waitForKeyPress();
        $this->bios->launch($this->os);
    }

    public function turnOff()
    {
        $this->os->halt();
        $this->bios->powerDown();
    }
}
