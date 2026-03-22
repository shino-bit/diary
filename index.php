<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
define('ROOT_DIR', __DIR__);
define('BASE_URL', 'http://back-end.local');
require_once ROOT_DIR . '/autoload.php';
$config = require_once ROOT_DIR . '/config/config.php';

$router = new Core\Router();

$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('home', ['controller' => 'Home', 'action' => 'index']);
$router->add('about', ['controller' => 'Home', 'action' => 'about']);
$router->add('contact', ['controller' => 'Home', 'action' => 'contact']);

$router->add('login', ['controller' => 'Auth', 'action' => 'login']);
$router->add('register', ['controller' => 'Auth', 'action' => 'register']);
$router->add('logout', ['controller' => 'Auth', 'action' => 'logout']);

$router->add('diary', ['controller' => 'Diary', 'action' => 'index']);
$router->add('diary/create', ['controller' => 'Diary', 'action' => 'create']);
$router->add('diary/edit/{id:\d+}', ['controller' => 'Diary', 'action' => 'edit']);
$router->add('diary/view/{id:\d+}', ['controller' => 'Diary', 'action' => 'view']);

$router->add('admin', ['controller' => 'Admin', 'action' => 'index']);
$router->add('admin/users', ['controller' => 'Admin', 'action' => 'users']);
$router->add('admin/entries', ['controller' => 'Admin', 'action' => 'entries']);

try {
    $router->dispatch();
} catch (Exception $e) {
    http_response_code(500);
    if ($config['app']['debug']) {
        echo "<h1>Помилка сервера</h1>";
        echo "<p><strong>Повідомлення:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
        echo "<p><strong>Файл:</strong> " . $e->getFile() . ":" . $e->getLine() . "</p>";
        echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
    } else {
        echo "Сталася помилка. Будь ласка, спробуйте пізніше.";
    }
    error_log("[" . date('Y-m-d H:i:s') . "] " . $e->getMessage() . 
              " in " . $e->getFile() . ":" . $e->getLine());
}
