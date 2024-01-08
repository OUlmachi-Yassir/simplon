<?php
class AdminController extends Controller
{
   

    public function adminD()
    {
        $categoryModel = $this->loadModel('CategoryModel');
        $categories = $categoryModel->getAllCategories();

        $data = [
            'categories' => $categories,
        ];

        $this->view('adminD', $data);
    }
}
