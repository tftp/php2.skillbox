<?php

// Mediator - Посредник - определяет объект инкапсулирующий способ взаимодействия множества объектов в системе.
// замыкает взаимодействие объектов на себя и координирует передачу информации между объектами

interface MediatorInterface
{
    public function makeRequest();
    public function sendResponse($content);
    public function loadData();
}

abstract class Colleague
{
    protected $mediator;

    public function setMediator(MediatorInterface $mediator)
    {
        $this->mediator = $mediator;
    }
}

class Client extends Colleague
{
    public function output($content)
    {
        echo $content . PHP_EOL;
    }

    public function request()
    {
        $this->mediator->makeRequest();
    }
}

class Server extends Colleague
{
    public function proccess()
    {
        $data  = $this->mediator->loadData();
        $this->mediator->sendResponse('Hello' . $data);
    }
}

class Database extends Colleague
{
    public function getData()
    {
        return 'World';
    }
}

// как они будут взаимодействовать
class Mediator implements MediatorInterface
{
    private $storage;
    private $client;
    private $server;

    public function __construct(Database $storage, Client $client, Server $server)
    {
        $this->storage = $storage;
        $this->servser = $server;
        $this->client = $client;

        $this->storage->setMediator($this);
        $this->client->setMediator($this);
        $this->server->setMediator($this);
    }

    public function makeRequest()
    {
        $this->server->proccess()
    }

    public function sendResponse($content)
    {
        $this->client->output($content);
    }

    public function loadData()
    {
        return $this->storage->getData();
    }
}

$client = new Client();
new Mediator(new Database() , $client, new Server());
$client->request();
