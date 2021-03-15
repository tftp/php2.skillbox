<?php

// Базовый паттерн.

// Registry - Глобальный объект, которыйиспользуется другими объектами для поиска общих объектов или служб.

class Register
{
    private static $data = [];

    public static function set(string $key, $value)
    {
        self::$data[$key] = $value;
    }

    public static function get(string $key, $defaultValue = null)
    {
        return self::$data[$key] ?? $defaultValue;
    }
}
