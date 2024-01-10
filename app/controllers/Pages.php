<?php
class Pages extends Controller
{
  private $categoryModel;
  protected $tagModel;
  public function __construct()
  {
    if(!isset($_SESSION['user_id'])){
      redirect('users/login');
    }
    $this->categoryModel = $this->model('Category');
    $this->tagModel = $this->model('Tag');
  }

  public function index()
  {

    $data = [
      'title' => 'Welcom'
    ];


    $this->view('pages/index', $data);
  }

  public function about()
  {
    $data = [
      'title' => 'About Us'
    ];

    $this->view('pages/about', $data);
  }

  public function login()
  {
    $data = [
      'title' => 'login'
    ];

    $this->view('pages/login', $data);
  }

  public function register()
  {
    $data = [
      'title' => 'register'
    ];

    $this->view('pages/register', $data);
  }

  public function authorD()
  {
    // Assuming you have a Wiki model
    $wikiModel = $this->model('Wiki');

    // Fetch wikis from the model
    $wikis = $wikiModel->getWikis();

    // Other necessary data like categories and tags
    $categories = $this->categoryModel->getCategories();
    $tags = $this->tagModel->getTags();

    $data = [
        'title' => 'Author Dashboard',
        'wikis' => $wikis,
        'categories' => $categories,
        'tags' => $tags,
    ];

    $this->view('pages/authorD', $data);
  }

  public function adminD()
  {
    $categories = $this->categoryModel->getCategories();
    $data = [
      'categories' => $categories,
      'tagModel' => $this->tagModel,
    ];
    $this->view('pages/adminD', $data);
  }
}
