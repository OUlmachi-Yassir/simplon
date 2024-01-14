<?php
class Pages extends Controller
{
  private $categoryModel;
  protected $tagModel;
  private $wikiModel;
  protected $userModel;
  public function __construct()
  {
    // if(!isset($_SESSION['user_id'])){
    //   redirect('users/login');
    // }
    $this->categoryModel = $this->model('Category');
    $this->tagModel = $this->model('Tag');
    $this->wikiModel = $this->model('Wiki'); // Assuming you have a Wiki model
    $this->userModel = $this->model('user');

  }


  public function addWiki()
  {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $title = $_POST['title'];
          $content = $_POST['content'];
          $categoryId = $_POST['category'];
          $authorId = $_SESSION['user_id'];
          $tags = isset($_POST['tags']) ? $_POST['tags'] : [];

          // Add the wiki to the wiki table
          $wikiId = $this->wikiModel->addWiki($title, $content,$authorId, $categoryId);

          // Add tags to the wikitag association table
          foreach ($tags as $tagId) {
              $this->wikiModel->addWikiTag($wikiId, $tagId);
          }

          // Redirect or show a success message
          redirect('pages/authorD');
      } else {
          // Fetch categories and tags for the form
        $categories = $this->categoryModel->getCategories();
        $tagsByCategory = [];

        // Assuming you have a method in Tag model to get tags by category
        foreach ($categories as $category) {
            $tagsByCategory[$category->categoryId] = $this->tagModel->getTagsByCategory($category->categoryId);
        }

        // Other necessary data like categories and tags
        $data = [
            'title' => 'Add Wiki',
            'categories' => $categories,
            'tagsByCategory' => $tagsByCategory,
        ];

        $this->view('pages/addWiki', $data); // Create a new view file 'addWiki.php'
    }
  }

 


  public function index()
  {

    // Assuming you have a Wiki model
    $wikiModel = $this->model('Wiki');

    // Fetch wikis from the model
    $wikis = $wikiModel->getWikis();
    $data = [
      'title' => 'Welcom',
      'wikis' => $wikis,
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
    $wikiCount = $this->wikiModel->getTotalWikisCount('wiki');
    $categoryCount = $this->categoryModel->getTotalCategoriesCount();
    $authorCount = $this->userModel->getTotalAuthorsCount('user');
    $categories = $this->categoryModel->getCategories();
    $data = [
      'categories' => $categories,
      'tagModel' => $this->tagModel,
      'wikiCount' => $wikiCount,
        'categoryCount' => $categoryCount,
        'authorCount' => $authorCount,
    ];
    $this->view('pages/adminD', $data);
  }


  public function searchSuggestions()
{
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['search_term'])) {
        // Get the search term from the Ajax request
        $title = filter_input(INPUT_GET, 'search_term', FILTER_SANITIZE_STRING);

        // Call the model to search for wikis by title and get suggestions
        $wikis = $this->wikiModel->searchWikisByTitle($title);

        // Render suggestions (you can use a separate view file for this)
        foreach ($wikis as $wiki) {
            echo '<p>' . $wiki->title . '</p>';
        }
    }
}
}
