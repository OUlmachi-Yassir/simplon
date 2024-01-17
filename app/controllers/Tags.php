<?php


class Tags extends Controller {
    private $tagModel;

    public function __construct() {
        $this->tagModel = $this->model('Tag');
    }

    public function add($categoryId) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize input
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

            if ($this->tagModel->addTag($name, $categoryId)) {
                redirect('categories');
            } else {
                die('Something went wrong');
            }
        } else {
            $this->view('tags/add', ['categoryId' => $categoryId]);
        }
    }

    public function edit($tagId) {
       
    }

    public function delete($tagId) {
        
    }

    public function index($categoryId) {
        $tags = $this->tagModel->getTagsByCategory($categoryId);
        $this->view('pages/adminD', ['tags' => $tags, 'categoryId' => $categoryId]);
    }

    public function getTagsByIdCategories()  {
        header('Content-Type: application/json');
      $idCategory=$_GET["idcate"];
      $Tags=  $this->tagModel->getTagsByCategory($idCategory); 
      $obTag=array();
      foreach ($Tags as $key => $value) {
      $obTag[]= get_object_vars($value);
      } 
       echo json_encode($obTag);
    }
}
