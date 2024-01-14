<?php

class Wikis extends Controller
{
    public $wikiModel;
    public $CategoryModel;
    public $tagModel;
    public $totalWikis;

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->wikiModel = $this->model('Wiki');
        $this->tagModel = $this->model('Tag');
        $this->CategoryModel = $this->model('Category');
    }

    public function index() {
        $categories = $this->CategoryModel->getCategories();
        $totalCategories = $this->CategoryModel->getTotalCategories();
        $totalTags =  $this->tagModel->getTotalTags();
        $totalWikis = $this->wikiModel->getTotalWikisCount();
        $lastWikiAuthor = $this->wikiModel->getLastWikiAuthor();

        $data = [
            'categories' => $categories,
            'totalCategories' => $totalCategories,
            'totalTags'=> $totalTags,
            'totalWikis' => $totalWikis,
            'lastWikiAuthor' => $lastWikiAuthor,

        ];


        $this->view('dashboard/dashboard', $data);

    }

    public function index1(){

        $wikis = $this->wikiModel->getWikis();
       
        $data = [
            'wikis' => $wikis,
            
        ];


        // $this->view('category/index', $data);
        $this->view('wikis/admin', $data);
        

    }

    public function index2(){

        $wikis = $this->wikiModel->getWikis();
        $data = [
            'wikis' => $wikis,
        ];


        // $this->view('category/index', $data);
        $this->view('wikis/index', $data);

    }

    public function show($id) {
        $wiki = $this->wikiModel->getWikiById($id);

        if (!$wiki) {
            
            redirect('pages/error');
        }

        $data = [
            'wiki' => $wiki,
          
        ];

        $this->view('wikis/show', $data);
    }


    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize and validate input
            $title = htmlspecialchars(trim($_POST['title']));
            $content = htmlspecialchars(trim($_POST['content']));
            $category_id = $_POST['category_id'];
            $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
            
            // Initialize error messages
            $title_err = '';
            $content_err = '';
            $category_err = '';
            $tags_err = '';
    
            // Validate title
            if (empty($title)) {
                $title_err = 'Le titre est requis';
            }
    
            // Validate content
            if (empty($content)) {
                $content_err = 'Le contenu est requis';
            }
    
            // Validate category_id (you may want to perform further validation if needed)
            if (empty($category_id)) {
                $category_err = 'La catégorie est requise';
            }
    
            // Validate tags
            $tags = isset($_POST['selectedTagsInput']) ? json_decode($_POST['selectedTagsInput'], true) : [];
            if (empty($tags)) {
                $tags_err = 'Au moins un tag est requis';
            }
    
            // Check if any error messages are set
            if (empty($title_err) && empty($content_err) && empty($category_err) && empty($tags_err)) {
                // Process form data if validation passes
                $data = [
                    'title' => $title,
                    'content' => $content,
                    'category_id' => $category_id,
                    'author_id' => $user_id,
                    'tags' => $tags,
                ];
    
                // Check if both title and content are non-empty
                if (!empty($data['title']) && !empty($data['content'])) {
                    if ($this->wikiModel->addWiki($data)) {
                        flash('wiki_message', 'Wiki ajouté avec succès', 'alert alert-success');
                        redirect('wikis/index2');
                    } else {
                        flash('wiki_message', 'Quelque chose s\'est mal passé', 'alert alert-danger');
                        redirect('wikis/add');
                    }
                } else {
                    flash('wiki_message', 'Le titre et le contenu ne peuvent pas être vides', 'alert alert-danger');
                    redirect('wikis/add');
                }
            } else {
                // Set flash messages for each error
                flash('title_err', $title_err, 'alert alert-danger');
                flash('content_err', $content_err, 'alert alert-danger');
                flash('category_err', $category_err, 'alert alert-danger');
                flash('tags_err', $tags_err, 'alert alert-danger');
                redirect('wikis/add');
            }
        }
    
        // Load the view with the necessary data (including the list of tags and error messages)
        $wikis = $this->wikiModel->getWikis();
    
        // Initialize CategoryModel before using it
        $this->CategoryModel = $this->model('Category');
        $categories = $this->CategoryModel->getCategories();
    
        $this->tagModel = $this->model('Tag'); // Make sure the model name is correct
    
        $categoryTags = [];
        foreach ($categories as $category) {
            $tags = $this->tagModel->getTagsByCategory($category->category_id);
            $categoryTags[$category->category_id] = $tags;
        }
    
        $data = [
            'categories' => $categories,
            'tagsList' => $this->wikiModel->getTags(), // Assuming you want to get tags from wikiModel
            'categoryTags' => $categoryTags,
            'wikis' => $wikis,
        ];
    
        $this->view('wikis/add', $data);
    }
    
    


    public function statistics()
    {
        $totalWikis = $this->wikiModel->getTotalWikisCount();

        $data = [
            'totalWikis' => $totalWikis,
        ];

        $this->view('dashboard/dashboard', $data);

    }

    public function edit($id)
    {
        $wiki = $this->wikiModel->getWikiById($id);

        if (!$wiki) {
            flash('wiki_message', 'Wiki not found', 'alert alert-danger');
            redirect('wikis');
        }

        $categories = $this->wikiModel->getCategories();
        $tags = $this->wikiModel->getTags();

        $data = [
            'wiki' => $wiki,
            'categories' => $categories,
            'tags' => $tags,
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize and validate input

            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'content' => trim($_POST['content']),
                'category_id' => $_POST['category_id'],
                'tags' => $_POST['tags'],
                'categories' => $categories,
            ];

            if ($this->wikiModel->updateWiki($data)) {
                flash('wiki_message', 'Wiki Updated');
                redirect('wikis/index2');
            } else {
                die('Something went wrong');
            }
        } else {
            $this->view('wikis/edit', $data);
        }
    }

    public function getTagsByCategory($categoryId)
    {
        // Load model
        $this->wikiModel = $this->model('Wiki');

        // Get tags associated with the selected category
        $tags = $this->wikiModel->getTagsByCategory($categoryId);

        // Convert the result to JSON and echo it
        echo json_encode($tags);
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Call the model method to delete the wiki
            if ($this->wikiModel->deleteWiki($id)) {
                flash('wiki_message', 'Wiki Deleted');
                redirect('wikis/index2');
            } else {
                die('Something went wrong');
            }
        } else {
            // Display confirmation form
            $wiki = $this->wikiModel->getWikiById($id);

            if (!$wiki) {
                flash('wiki_message', 'Wiki not found', 'alert alert-danger');
                redirect('wikis');
            }

            $data = [
                'wiki' => $wiki,
            ];

            $this->view('wikis/delete', $data); 
        }
    }

    public function archive($id)
    {
        if ($this->wikiModel->archiveWiki($id)) {
            // Redirect or show success message
            flash('wiki_message', 'Wiki Archived');
            redirect('wikis/index1');
        } else {
            die('Something went wrong');
        }
    }


    public function userWikis()
{
   
    $userWikis = $this->wikiModel->getWikisByUserId($_SESSION['user_id']);

   
    $data = [
        'userWikis' => $userWikis,
    ];

   
    $this->view('wikis/userWikis', $data);
}


public function search()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';

            // Call a method in your model to perform the search
            $searchResults = $this->wikiModel->searchWikis($searchTerm);

            // Return the results in JSON format
            header('Content-Type: application/json');
            echo json_encode($searchResults);

            exit;
        }

    }
}
