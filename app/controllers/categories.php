<?php

// app/controllers/Categories.php
class Categories extends Controller {
    public function __construct() {
        $this->categoryModel = $this->model('Category');
    }

    // Add a category
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize input
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

            if ($this->categoryModel->addCategory($name)) {
                redirect('categories');
            } else {
                die('Something went wrong');
            }
        } else {
            $this->view('categories/add');
        }
    }

    // Edit a category
    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize input
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

            if ($this->categoryModel->updateCategory($id, $name)) {
                redirect('categories');
            } else {
                die('Something went wrong');
            }
        } else {
            $category = $this->categoryModel->getCategoryById($id);
            $this->view('categories/edit', ['category' => $category]);
        }
    }

    // Delete a category
    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->categoryModel->deleteCategory($id)) {
                redirect('categories');
            } else {
                die('Something went wrong');
            }
        } else {
            redirect('categories');
        }
    }

    // Display all categories
    public function index() {
        $categories = $this->categoryModel->getCategories();
        $this->view('categories/index', ['categories' => $categories]);
    }
}
