<?php

class Category
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getCategories()
    {
        $this->db->query('SELECT * FROM categories');
        return $this->db->resultSet();
    }

    public function addCategory($data)
    {
        $this->db->query('INSERT INTO categories (category_name) VALUES (:category_name)');
        $this->db->bind(':category_name', $data['category_name']);

        return $this->db->execute();
    }

    public function deleteCategory($id)
    {
        $this->db->query('DELETE FROM categories WHERE category_id = :category_id');
        $this->db->bind(':category_id', $id);

        return $this->db->execute();
    }

    public function updateCategory($data)
    {
        $this->db->query('UPDATE categories SET category_name = :category_name WHERE category_id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':category_name', $data['category_name']);

        return $this->db->execute();
    }

    public function getCategoryById($id)
    {
        $this->db->query('SELECT * FROM categories WHERE category_id = :id');
        $this->db->bind(':id', $id);

        return $this->db->single();
    }
}
