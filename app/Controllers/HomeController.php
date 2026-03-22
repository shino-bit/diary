<?php
namespace App\Controllers;

use Core\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
        $data = [
            'title' => 'Головна сторінка',
            'welcome' => 'Ласкаво просимо до онлайн-щоденника!',
            'description' => 'Це ваш особистий простір для записів, думок та спогадів.',
            'features' => [
                'Особисті записи',
                'Захищені дані',
                'Категорії та теги',
                'Експорт даних'
            ]
        ];
        
        $this->view('home/index', $data);
    }
    
    public function aboutAction()
    {
        $data = [
            'title' => 'Про проект',
            'content' => 'Онлайн-щоденник - це веб-додаток для особистого ведення записів.'
        ];
        
        $this->view('home/about', $data);
    }
    
    public function contactAction()
    {
        $data = [
            'title' => 'Контакти',
            'content' => 'Зв\'яжіться з нами для отримання допомоги.'
        ];
        
        $this->view('home/contact', $data);
    }
}
