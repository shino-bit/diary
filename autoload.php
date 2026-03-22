<?php
spl_autoload_register(function ($className) {
    $file = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';
    if (file_exists($file)) {
        require_once $file;
        return;
    }
    throw new Exception("Клас {$className} не знайдено. Файл: {$file}");
});
