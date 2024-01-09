<?php

// app/controllers/Categories.php
class Categories extends Controller
{
    private $categoryModel;
    protected $tagModel;
    public function __construct()
    {
        $this->categoryModel = $this->model('Category');
        $this->tagModel = $this->model('Tag');
    }

    // Add a category
    public function add()
    {
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
    public function edit($id)
    {
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
    public function delete($id)
    {
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


    // Add a tag to a category
    public function addTag($categoryId) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize input
            $name = filter_input(INPUT_POST, 'tag_name', FILTER_SANITIZE_STRING);

            if ($this->tagModel->addTag($name, $categoryId)) {
                redirect('categories');
            } else {
                die('Something went wrong');
            }
        } else {
            // Load your view for adding tags
            $this->view('categories/addTag', ['categoryId' => $categoryId]);
        }
    }

    // Edit a tag
    public function editTag($tagId) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize input
            $name = filter_input(INPUT_POST, 'tag_name', FILTER_SANITIZE_STRING);

            if ($this->tagModel->editTag($tagId, $name)) {
                redirect('categories');
            } else {
                die('Something went wrong');
            }
        } else {
            // Load your view for editing tags
            $tag = $this->tagModel->getTagById($tagId);
            $this->view('categories/editTag', ['tag' => $tag]);
        }
    }

    // Delete a tag
    public function deleteTag($tagId) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->tagModel->deleteTag($tagId)) {
                redirect('categories');
            } else {
                die('Something went wrong');
            }
        } else {
            redirect('categories');
        }
    }

    public function index()
    {
        $categories = $this->categoryModel->getCategories();
        $this->view('pages/adminD', ['categories' => $categories]);
    }

}
