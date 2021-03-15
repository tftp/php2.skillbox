<?php
namespace App;

class Application
{
    public $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function run()
    {
        $this->router->dispatch();
    }
}
