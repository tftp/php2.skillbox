<?php

// Структурные паттерны программирования - определяют как из классов и объектов образуются более сложные структуры

// Адаптер - преобразует интерфейс одного класса в интерфейс другого. Обеспечивает работу классов с несовместимыми интерфейсами.

interface SocialNetworkAuth
{
    public function auth();
    public function getUserData();
}

class VkAuth implements SocialNetworkAuth
{
    public function auth()
    {
        // логика авторизации в вк
    }

    public function getUserData()
    {
        // отправляем запросы, получаем данные
    }
}

class InstagrammOAuth
{
    public function authByID()
    {
        // реализация
    }

    public function getUserID()
    {
        // реализация
    }

    public function getFotos()
    {
        // реализация
    }

    public function getUserInfo()
    {
        // реализация
    }
}

// Как заствить работать InstagrammOAuth с нашим интерфейсом? Для этого мы создаем Адаптер

class InstagramAdapter implements SocialNetworkAuth
{
    private $adaptee;

    public function __construct()
    {
        $this->adaptee = new InstagrammOAuth();
    }

    public function auth()
    {
        $this->adaptee->authByID($this->adaptee->getUserID());
    }

    public function getUserData()
    {
        $this->adaptee->getUserInfo();
    }
}

// Клиентский код
function auth(SocialNetworkAuth $provider) {
    $provider->auth();
}

$instagram = new InstagramAdapter();
auth($instagram);

$vk = new VkAuth();
auth($vk);
