<?php

// Identity Map - Коллекция объектов - гарантирует что объект загрузится из БД один раз и хранится в спец коллекции

class IdentityMap
{
    private $items;

    public function hasId($id)
    {
        return isset($this->items[$id]);
    }

    public function get($id)
    {
        return $this->items[$id];
    }

    public function set($id, $value)
    {
        $this->items[$id] = $value;
        return $this;
    }
}

class UserMapper
{
    private $adapter;
    private $identityMap;

    public function __construct(StorageAdapter $adapter)
    {
        $this->adapter = $adapter;
        $this->identityMap = new IdentityMap();
    }

    public function findById($id)
    {
        if ($this->identityMap->hasId($id)){
            return $this->identityMap->getId($id);
        }

        $result = $this->adapter->find($id);

        if ($result === null)
        {
            throw new \InvalidArgumentException("User #$id not found");
        }

        $item = $this->mapRowToUser($result);

        $this->identityMap->set($id, $item);

        return $item;
    }

    public function mapRowToUser(array $row) : User
    {
        return User::fromState($row);
    }
}
