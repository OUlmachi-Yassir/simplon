<?php
class Pages extends Controller
{
  private $categoryModel;
  protected $tagModel;
  private $wikiModel;
  public function __construct()
  {
    if(!isset($_SESSION['user_id'])){
      redirect('users/login');
    }
    $this->categoryModel = $this->model('Category');
    $this->tagModel = $this->model('Tag');
    $this->wikiModel = $this->model('Wiki'); // Assuming you have a Wiki model

  }


  public function addWiki()
  {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $title = $_POST['title'];
          $content = $_POST['content'];
          $categoryId = $_POST['category'];
          $tags = isset($_POST['tags']) ? $_POST['tags'] : [];

          // Add the wiki to the wiki table
          $wikiId = $this->wikiModel->addWiki($title, $content, $categoryId);

          // Add tags to the wikitag association table
          foreach ($tags as $tagId) {
              $this->wikiModel->addWikiTag($wikiId, $tagId);
          }

          // Redirect or show a success message
          redirect('pages/authorD');
      } else {
          // Handle non-POST requests
          redirect('pages/authorD'); 
      }
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
