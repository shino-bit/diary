<?php

namespace Core;

abstract class Model
{
    protected $db;
    protected $table;
    protected $primaryKey = 'id';
    
    public function __construct()
    {
        $this->db = Database::getInstance();
    }
    
    public function find($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = ?";
        return $this->db->fetch($sql, [$id]);
    }
    
    public function findAll()
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->db->fetchAll($sql);
    }
    
    public function create($data)
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        $sql = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";
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
        $sql = "UPDATE {$this->table} SET $set WHERE {$this->primaryKey} = ?";
        $params = array_values($data);
        $params[] = $id;
        return $this->db->query($sql, $params);
    }
    
    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = ?";
        return $this->db->query($sql, [$id]);
    }
    
    public function where($conditions, $params = [])
    {
        $where = [];
        $values = [];
        
        foreach ($conditions as $column => $value) {
            $where[] = "$column = ?";
            $values[] = $value;
        }
        
        $where = implode(' AND ', $where);
        $sql = "SELECT * FROM {$this->table} WHERE $where";
        return $this->db->fetchAll($sql, $values);
    }
    
    public function execute($sql, $params = [])
    {
        return $this->db->query($sql, $params);
    }
}
