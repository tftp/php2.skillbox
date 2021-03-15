<?php

// Объектно - реляционные паттерны. Слой приложения,отвечающий за доступ к данным.

// Data Mapper - Преобразователь данных - передача данных между объектами и базой данных

class User
{
    private $name;
    private $email;

    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    public static function fromState(array $state)
    {
        return new static($state['name'], $state['email']);
    }
}

class StorageAdapter
{
    public function find($id)
    {
        return ['name' => 'User1', 'email' => 'user1@local.ru'];
    }
}

class UserMapper
{
    private $adapter;

    public function __construct(StorageAdapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function findById($id)
    {
        $result = $this->adapter->find($id);

        if ($result === null)
        {
            throw new \InvalidArgumentException("User #$id not found");
        }

        return $this->mapRowToUser($result);
    }

    public function mapRowToUser(array $row) : User
    {
        return User::fromState($row);
    }
}

$mapper = new UserMapper(new StorageAdapter());

$user = $mapper->findById(1);

print_r($user);
