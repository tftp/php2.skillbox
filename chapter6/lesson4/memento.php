<?php

// Memento - Хранитель - запоминает состояние объекта

class State
{
    const STATE_OPENED = 'open';
    const STATE_CLOSED = 'close';

    private $state;

    public function __construct(string $state)
    {
        $this-state = $state;
    }

    public function __toString() : string
    {
        return $this->state;
    }
}

class Memento
{
    private $state;

    public function __construct(State $stateToSave)
    {
        $this->state = $stateToSave;
    }

    public function getState()
    {
        return $this->state;
    }
}

class Ticket
{
    private $currentState;

    public function __construct()
    {
        $this->currentState = new State(State::STATE_OPENED);
    }

    public function open()
    {
        $this->currentState = new State(State::STATE_OPENED);
    }

    public function close()
    {
        $this->currentState = new State(State::STATE_CLOSED);
    }

    public function saveToMemento() : Memento
    {
        return new Memento(clone $this->currentState);
    }

    public function restoreFromMemento(Memento $memento)
    {
        $this->currentState = $memento->getState();
    }

    public function getState() : State
    {
        return $this->currentState;
    }
}

echo '<pre>';
$ticket = new Ticket();

$ticket->open();
echo $ticket->getState() . PHP_EOL;

$memento = $ticket->saveToMemento();

$ticket->close();
echo $ticket->getState() . PHP_EOL;

$ticket->restoreFromMemento($memento);
echo $ticket->getState() . PHP_EOL;
echo '</pre>';
