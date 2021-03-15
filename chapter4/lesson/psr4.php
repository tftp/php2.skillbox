<?php

spl_autoload_register(function($class) {

    //Префикс пространства имен
    $prefix = 'Foo\\Bar\\';

    //Базовый каталог для префикса пространства имен
    $base_dir = __DIR__ . '/src/';

    //использует ли класс префикс пространства имен?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        //нет, переходим к следующему автоподгрузчику
        return;
    }

    //получаем относительное имя класса
    $relative_class = substr($class, $len);

    //Создаем имя файла
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    //если файл существует подключаем его
    if (file_exists($file)) {
        require $file;
    }
});
