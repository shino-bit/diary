<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
define('ROOT_DIR', __DIR__);
define('BASE_URL', 'http://back-end.local');
require_once ROOT_DIR . '/autoload.php';
// Перевірка існування файлу
$routerFile = __DIR__ . '/Core/Router.php';
echo "Шлях до файлу: " . $routerFile . "<br>";
echo "Файл існує: " . (file_exists($routerFile) ? 'Так' : 'Ні') . "<br>";

// Спробуйте підключити файл безпосередньо
if (file_exists($routerFile)) {
    require_once $routerFile;
    echo "Клас Router існує: " . (class_exists('Core\Router') ? 'Так' : 'Ні') . "<br>";
}


$router = new Core\Router();

// Головна сторінка
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('home', ['controller' => 'Home', 'action' => 'index']);
$router->add('about', ['controller' => 'Home', 'action' => 'about']);
$router->add('contact', ['controller' => 'Home', 'action' => 'contact']);

// Аутентифікація (новий стиль з методом)
$router->add('GET', '/login', 'AuthController@loginForm');
$router->add('POST', '/login', 'AuthController@login');
$router->add('GET', '/register', 'AuthController@registerForm');
$router->add('POST', '/register', 'AuthController@register');
$router->add('GET', '/logout', 'AuthController@logout');

// Щоденник (новий стиль)
$router->add('GET', '/diary', 'DiaryController@index');
$router->add('GET', '/diary/create', 'DiaryController@create');
$router->add('POST', '/diary/create', 'DiaryController@create');
$router->add('GET', '/diary/view/(\d+)', 'DiaryController@show');
$router->add('GET', '/diary/edit/(\d+)', 'DiaryController@edit');
$router->add('POST', '/diary/edit/(\d+)', 'DiaryController@edit');
$router->add('GET', '/diary/delete/(\d+)', 'DiaryController@delete');
$router->add('POST', '/diary/delete/(\d+)', 'DiaryController@delete');

// Адмінка (старий стиль)
$router->add('admin', ['controller' => 'Admin', 'action' => 'index']);
$router->add('admin/users', ['controller' => 'Admin', 'action' => 'users']);
$router->add('admin/entries', ['controller' => 'Admin', 'action' => 'entries']);

try {
    $router->dispatch();
} catch (Exception $e) {
    http_response_code(500);
    echo "<h1>Помилка сервера</h1>";
    echo "<p><strong>Повідомлення:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p><strong>Файл:</strong> " . $e->getFile() . ":" . $e->getLine() . "</p>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
    error_log("[" . date('Y-m-d H:i:s') . "] " . $e->getMessage() . 
              " in " . $e->getFile() . ":" . $e->getLine());
}
