<?php

// Unit of Work - Еденица работы - отслеживает изменение данных в рамках бизнес транзакции

class UnitOfWork
{
    private $news = [];
    private $updates = [];
    private $deletes = [];

    public function addNew($item)
    {
        $this->news[] = $item;
        return $this;
    }

    public function addUpdate($item)
    {
        $this->updates[] = $item;
        return $this;
    }

    public function addDelete($item)
    {
        $this->deletes[] = $item;
        return $this;
    }

    public function commit()
    {
        foreach ($this->news as $item) {
            echo 'Добавляем ' . $item . PHP_EOL;
        }

        foreach ($this->updates as $item) {
            echo 'Обновляем ' . $item . PHP_EOL;
        }

        foreach ($this->deletes as $item) {
            echo 'Удаляем ' . $item . PHP_EOL;
        }
    }
}

echo '<pre>';

$work = new UnitOfWork();
$work
    ->addNew('Масла в огонь')
    ->addUpdate('Сметану')
    ->addUpdate('Иммунетет')
    ->addDelete('Болезнь')
    ->addNew('Чудесное настроение')
;
$work->commit();

echo '</pre>';
