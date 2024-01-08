<?php

// app/models/Category.php
class Category
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Add a new category
    public function addCategory($name)
    {
        $this->db->query('INSERT INTO category (name) VALUES (:name)');
        $this->db->bind(':name', $name);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Get all categories
    public function getCategories()
    {
        $this->db->query('SELECT * FROM category');
        return $this->db->resultSet();
    }

    // Get a category by ID
    public function getCategoryById($categoryId)
    {
        $this->db->query('SELECT * FROM category WHERE categoryId = :categoryId');
        $this->db->bind(':categoryId', $categoryId);
        return $this->db->single();
    }

    // Update a category by ID
    public function updateCategory($categoryId, $name)
    {
        $this->db->query('UPDATE category SET name = :name WHERE categoryId = :categoryId');
        $this->db->bind(':name', $name);
        $this->db->bind(':categoryId', $categoryId);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Delete a category by ID
    public function deleteCategory($categoryId)
    {
        $this->db->query('DELETE FROM category WHERE categoryId = :categoryId');
        $this->db->bind(':categoryId', $categoryId);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
