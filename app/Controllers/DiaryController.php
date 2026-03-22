<?php

namespace App\Controllers;

use App\Models\DiaryEntry;
use Core\Controller;

class DiaryController extends Controller
{
    public function index()
    {
        // Перевірка авторизації
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $diaryEntryModel = new DiaryEntry();
        $entries = $diaryEntryModel->getAllByUser($_SESSION['user_id']);
        
        $data = [
            'entries' => $entries
        ];
        
        $this->view('diary/index', $data);
    }

    public function show($id)  // ЗМІНЕНО З view на show
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $diaryEntryModel = new DiaryEntry();
        $entry = $diaryEntryModel->getByIdAndUser($id, $_SESSION['user_id']);
        
        if (!$entry) {
            header('Location: /diary');
            exit;
        }
        
        $data = [
            'entry' => $entry
        ];
        
        $this->view('diary/view', $data);
    }

    public function create()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $entry_date = $_POST['entry_date'] ?? date('Y-m-d');
            $content = $_POST['content'] ?? '';
            
            $diaryEntryModel = new DiaryEntry();
            $success = $diaryEntryModel->create([
                'user_id' => $_SESSION['user_id'],
                'title' => $title,
                'entry_date' => $entry_date,
                'content' => $content,
                'created_at' => date('Y-m-d H:i:s')
            ]);
            
            if ($success) {
                $_SESSION['flash_message'] = 'Запис успішно створено!';
                header('Location: /diary');
                exit;
            } else {
                $_SESSION['flash_error'] = 'Помилка при створенні запису';
            }
        }
        
        $this->view('diary/create');
    }

    public function edit($id)
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $diaryEntryModel = new DiaryEntry();
        $entry = $diaryEntryModel->getByIdAndUser($id, $_SESSION['user_id']);
        
        if (!$entry) {
            header('Location: /diary');
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $entry_date = $_POST['entry_date'] ?? date('Y-m-d');
            $content = $_POST['content'] ?? '';
            
            $success = $diaryEntryModel->update($id, [
                'title' => $title,
                'entry_date' => $entry_date,
                'content' => $content,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            
            if ($success) {
                $_SESSION['flash_message'] = 'Запис успішно оновлено!';
                header('Location: /diary/view/' . $id);
                exit;
            } else {
                $_SESSION['flash_error'] = 'Помилка при оновленні запису';
            }
        }
        
        $data = [
            'entry' => $entry
        ];
        
        $this->view('diary/edit', $data);
    }

    public function delete($id)
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $diaryEntryModel = new DiaryEntry();
        $entry = $diaryEntryModel->getByIdAndUser($id, $_SESSION['user_id']);
        
        if (!$entry) {
            header('Location: /diary');
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $success = $diaryEntryModel->delete($id);
            
            if ($success) {
                $_SESSION['flash_message'] = 'Запис успішно видалено!';
            } else {
                $_SESSION['flash_error'] = 'Помилка при видаленні запису';
            }
            
            header('Location: /diary');
            exit;
        }
        
        $data = [
            'entry' => $entry
        ];
        
        $this->view('diary/delete', $data);
    }
}
