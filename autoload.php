<?php
spl_autoload_register(function ($className) {
    $rootDir = defined('ROOT_DIR') ? ROOT_DIR : __DIR__;
    
    $file = '';
    
    if (strpos($className, 'Core\\') === 0) {
        $className = str_replace('Core\\', '', $className);
        $file = $rootDir . '/core/' . str_replace('\\', '/', $className) . '.php';
    }
    elseif (strpos($className, 'App\\') === 0) {
        $className = str_replace('App\\', '', $className);
        $file = $rootDir . '/app/' . str_replace('\\', '/', $className) . '.php';
    }
    else {
        $file = $rootDir . '/' . str_replace('\\', '/', $className) . '.php';
    }
    
    if ($file && file_exists($file)) {
        require_once $file;
        return;
    }
    
    throw new Exception("Клас {$className} не знайдено. Файл: {$file}");
});
