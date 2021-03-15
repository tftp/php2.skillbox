<?php

// State - Состояние - объект ведет себя в зависимости от внутреннего состояния

interface State
{
    public function proceedToNext(OrderContext $context);
    public function toString() : string;
}

class StateCreated implements State
{
    public function proceedToNext(OrderContext $context)
    {
        $context->setState(new StateShipped());
    }

    public function toString() : string
    {
        return 'created';
    }
}

class StateShipped implements State
{
    public function proceedToNext(OrderContext $context)
    {
        $context->setState(new StateDone());
    }

    public function toString() : string
    {
        return 'shipped';
    }
}

class StateDone implements State
{
    public function proceedToNext(OrderContext $context)
    {

    }

    public function toString() : string
    {
        return 'done';
    }
}

class OrderContext
{
    private $state;
    public static function create() : OrderContext
    {
        $order = new self();
        $order->state = new StateCreated();
        return $order;
    }

    public function setState(State $state)
    {
        $this->state = $state;
    }

    public function proceedToNext()
    {
        $this->state->proceedToNext($this);
    }

    public function toString()
    {
        return $this-state->toString();
    }
}

echo '<pre>';

$order = OrderContext::create();

echo $order->toString() . PHP_EOL;

$order->proceedToNext();
echo $order->toString() . PHP_EOL;

$order->proceedToNext();
echo $order->toString() . PHP_EOL;

$order->proceedToNext();
echo $order->toString() . PHP_EOL;

echo '</pre>';
