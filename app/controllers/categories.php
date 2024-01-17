<?php
class Categories extends Controller
{
    private $categoryModel;
    protected $tagModel;
    protected $wikiModel;
    protected $userModel;
    public function __construct()
    {
        $this->categoryModel = $this->model('Category');
        $this->tagModel = $this->model('Tag');
        $this->wikiModel = $this->model('Wiki');
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
            $this->view('categorie/add');
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
            $this->view('categorie/edit', ['category' => $category]);
        }
    }

    // Delete a category
    public function delete($id)
    {
        $tags = $this->tagModel->getTagsByCategory($id);
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
            $this->view('categorie/addTag', ['categoryId' => $categoryId]);
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
            $this->view('categorie/editTag', ['tag' => $tag]);
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


    // Display wikis on authorD.php
    public function displayWikisForAuthor()
    {
        // Fetch all wikis
        $wikis = $this->wikiModel->getAllWikis();

        // Load your view for displaying wikis for the author
        $this->view('pages/authorD', ['wikis' => $wikis]);
    }
    


    public function deleteWiki($wikiId)
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($this->wikiModel->deleteWiki($wikiId)) {
            redirect('categories');
        } else {
            die('Something went wrong');

        }
    } else {
        redirect('categories');
    }
}

// Edit a wiki
public function editWiki($id)
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Sanitize input
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
        $categoryId = filter_input(INPUT_POST, 'category', FILTER_VALIDATE_INT);

        // Perform validation as needed

        if ($this->wikiModel->updateWiki($id, $title, $content, $categoryId)) {
            redirect('categorie');
        } else {
            die('Something went wrong');
        }
    } else {
        $wiki = $this->wikiModel->getWikiById($id);
        $categories = $this->categoryModel->getCategories();
        $this->view('categorie/editWiki', ['wiki' => $wiki, 'categories' => $categories]);
    }
}

public function archiveWiki($wikiId)
{
    $this->wikiModel->archiveWiki($wikiId);
    if ($this->wikiModel->archiveWiki($wikiId)) {
        // Redirect or handle success
        redirect('pages/index');
    } else {
        // Handle failure
        redirect('pages/index');
        die('Failed to archive the wiki.');
    }
}


    public function index()
    {
        $categories = $this->categoryModel->getCategories();
        $this->view('pages/adminD', ['categories' => $categories]);
    }



    public function showStatistics()
{
    

    $wikiCount = $this->wikiModel->getTotalWikisCount('wiki');
    $categoryCount = $this->categoryModel->getTotalCategoriesCount();
    $authorCount = $this->userModel->getTotalAuthorsCount('user');

//     var_dump($wikiCount, $categoryCount, $authorCount); // Debugging statement
//    die();
    $data = [
        'wikiCount' => $wikiCount,
        'categoryCount' => $categoryCount,
        'authorCount' => $authorCount,
    ];
//   var_dump($data);
//     die();

 $this->view('pages/adminD', $data);
}
}
