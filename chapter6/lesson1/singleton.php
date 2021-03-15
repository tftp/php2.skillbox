<?php

// Порождающие шаблоны проектирования

// Паттерн Одиночка - аналог глобальной переменной,
// гарантирует что у класса будет только один экземпляр и представляет к нему глобальную точку доступа

final class Singleton
{
    private static $instance;

    private function __construct() {}

    public static function getInstance() : Singleton
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }
}

// Клиентский код

$singletonObject = Singleton::getInstance();

// Пример реализации для конфигурации
final class Configuration
{
    private static $instance;
    private $configs = [];

    private function __construct() {}

    public static function getInstance() : Singleton
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    public function getConfig($key, $default = null)
    {
        return $this->configs[$key] ?? $default;
    }

    public function setConfig($key, $value)
    {
        $this->configs[$key] = $value;
        return $this;
    }
}

// Клиентский код
$config = Configuration::getInstance();
$config
    ->setConfig('user', 1)
    ->setConfig('is_admin', false)
    ->setConfig('last_login', time())
;
