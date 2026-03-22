<?php

namespace App\Models;

use Core\Model;

class DiaryEntry extends Model
{
    protected $table = 'diary_entries';
    
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllByUser($userId)
    {
        $sql = "SELECT * FROM diary_entries WHERE user_id = ? ORDER BY entry_date DESC, created_at DESC";
        return $this->db->fetchAll($sql, [$userId]);
    }

    public function getByIdAndUser($id, $userId)
    {
        $sql = "SELECT * FROM diary_entries WHERE id = ? AND user_id = ?";
        return $this->db->fetch($sql, [$id, $userId]);
    }

    public function create($data)
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        $sql = "INSERT INTO diary_entries ($columns) VALUES ($placeholders)";
        $this->db->query($sql, array_values($data));
        return $this->db->lastInsertId();
    }

    public function update($id, $data)
    {
        $set = [];
        foreach ($data as $column => $value) {
            $set[] = "$column = ?";
        }
        $set = implode(', ', $set);
        $sql = "UPDATE diary_entries SET $set WHERE id = ?";
        $params = array_values($data);
        $params[] = $id;
        return $this->db->query($sql, $params);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM diary_entries WHERE id = ?";
        return $this->db->query($sql, [$id]);
    }
}
