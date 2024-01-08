<?php
class AdminController extends Controller
{
    private $categoryModel;
    public function __construct()
    {
        $this->categoryModel = $this->model('Category');
    }



}
