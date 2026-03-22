<?php
namespace Core;

class Controller
{
    protected $route_params = [];
    
    public function __construct($route_params)
    {
        $this->route_params = $route_params;
    }
    
    public function __call($name, $args)
    {
        $method = $name . 'Action';
        if (method_exists($this, $method)) {
            if ($this->before() !== false) {
                call_user_func_array([$this, $method], $args);
                $this->after();
            }
        } else {
            throw new \Exception("Метод $method не знайдено в контролері " . get_class($this));
        }
    }
    
    protected function before()
    {
    }
    
    protected function after()
    {
    }
    
    protected function view($view, $data = [])
    {
        extract($data);
        $view_file = ROOT_DIR . '/app/Views/' . $view . '.php';
        if (file_exists($view_file)) {
            require $view_file;
        } else {
            throw new \Exception("Файл представлення $view_file не знайдено");
        }
    }
    
    protected function redirect($url)
    {
        header('Location: ' . BASE_URL . $url);
        exit;
    }
    
    protected function json($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}
