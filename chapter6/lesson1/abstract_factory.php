<?php

// Порождающие шаблоны проектирования

// Абстрактная фабрика - представляет интерфейс для создания семейств объектов
// не привязываясь к конкретным реализациям

interface Chair {}
interface Table {}
interface Couch {}

class WoodenChair implements Chair {}
class WoodenTable implements Tables {}
class WoodenCouch implements Couch {}

interface FurnitureFactory
{
    public function createChair() : Chair;
    public function createTable() : Table;
    public function createCouch() : Couch;
}

class WoodenFurnitureFactory implements FurnitureFactory
{
    public function createChair() : Chair
    {
        return new WoodenChair();
    }

    public function createTable() : Table
    {
        return new WoodenTable();
    }

    public function createCouch() : Couch
    {
        return new WoodenCouch();
    }
}

// Теперь создаем абстрактную фабрику
class Fabric
{
    const MATERIAL_WOOD = 'wood';

    public static function createFactory($fabric) : FurnitureFactory
    {
        switch ($fabric) {
            case static::MATERIAL_WOOD:
                return new WoodenFurnitureFactory();
        }
    }
}

// Клиентский код
function getFurnitureCollection($type)
{
    $fabric = Fabric::createFactory($type);

    return [
        'chair' => $fabric->createChair(),
        'table' => $fabric->createTable(),
        'couch' => $fabric->createCouch()
    ];
}

$collection = getFurnitureCollection(Fabric::MATERIAL_WOOD);
