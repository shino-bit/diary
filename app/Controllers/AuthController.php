<?php

namespace App\Controllers;

use App\Models\User;
use Core\Controller;

class AuthController extends Controller
{
    public function loginForm()
    {
        if (isset($_SESSION['user_id'])) {
            header('Location: /');
            exit;
        }
        
        $this->view('auth/login');
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /login');
            exit;
        }

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $userModel = new User();
        $user = $userModel->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['flash_message'] = 'Вітаємо! Ви успішно увійшли.';
            header('Location: /diary');
            exit;
        } else {
            $_SESSION['flash_error'] = 'Невірний email або пароль';
            header('Location: /login');
            exit;
        }
    }

    public function registerForm()
    {
        if (isset($_SESSION['user_id'])) {
            header('Location: /');
            exit;
        }
        
        $this->view('auth/register');
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /register');
            exit;
        }

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';

        if (empty($email) || empty($password)) {
            $_SESSION['flash_error'] = 'Усі поля обов\'язкові';
            header('Location: /register');
            exit;
        }

        if ($password !== $confirm_password) {
            $_SESSION['flash_error'] = 'Паролі не співпадають';
            header('Location: /register');
            exit;
        }

        if (strlen($password) < 6) {
            $_SESSION['flash_error'] = 'Пароль має містити щонайменше 6 символів';
            header('Location: /register');
            exit;
        }

        $userModel = new User();
        
        if ($userModel->findByEmail($email)) {
            $_SESSION['flash_error'] = 'Цей email вже зареєстрований';
            header('Location: /register');
            exit;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $userId = $userModel->create([
            'email' => $email,
            'password' => $hashedPassword
        ]);

        if ($userId) {
            $_SESSION['flash_message'] = 'Реєстрація успішна! Тепер увійдіть.';
            header('Location: /login');
            exit;
        } else {
            $_SESSION['flash_error'] = 'Помилка при реєстрації';
            header('Location: /register');
            exit;
        }
    }

    public function logout()
    {
        session_destroy();
        $_SESSION['flash_message'] = 'Ви успішно вийшли';
        header('Location: /');
        exit;
    }
}
