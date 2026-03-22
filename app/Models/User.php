<?php

namespace App\Models;

use Core\Model;
use PDO;

class User extends Model
{
    protected $table = 'users';
    
    public function __construct()
    {
        parent::__construct();
    }

    public function findByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        return $this->db->fetch($sql, [$email]);
    }

    public function create($data)
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        $sql = "INSERT INTO users ($columns) VALUES ($placeholders)";
        $this->db->query($sql, array_values($data));
        return $this->db->lastInsertId();
    }
}
