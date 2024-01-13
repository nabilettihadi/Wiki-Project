<?php

class Wikis extends Controller
{

    public $wikiModel;
    public $CategoryModel;
    public $tagModel;
    public $totalWikis;

    public function __construct()
    {
        // Vérifier si l'utilisateur est connecté
        if (!isLoggedIn()) {
            redirect('users/login');
        }

  
        $this->wikiModel = $this->model('Wiki');
        $this->tagModel = $this->model('Tag');
        $this->CategoryModel = $this->model('Category');
    }


    public function index()
    {
 
        $categories = $this->CategoryModel->getCategories();
        $totalCategories = $this->CategoryModel->getTotalCategories();
        $totalTags = $this->tagModel->getTotalTags();
        $totalWikis = $this->wikiModel->getTotalWikisCount();


        $data = [
            'categories' => $categories,
            'totalCategories' => $totalCategories,
            'totalTags' => $totalTags,
            'totalWikis' => $totalWikis,
        ];


        $this->view('dashboard/dashboard', $data);
    }


    public function index1()
    {

        $wikis = $this->wikiModel->getWikis();
        $data = [
            'wikis' => $wikis,
        ];


        $this->view('wikis/admin', $data);
    }


    public function index2()
    {

        $wikis = $this->wikiModel->getWikis();
        $data = [
            'wikis' => $wikis,
        ];


        $this->view('wikis/index', $data);
    }


    public function show($id)
    {

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

            $title = htmlspecialchars(trim($_POST['title']));
            $content = htmlspecialchars(trim($_POST['content']));
            $category_id = $_POST['category_id'];
            $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
            $tags = isset($_POST['selectedTagsInput']) ? json_decode($_POST['selectedTagsInput'], true) : [];
            $data = [
                'title' => $title,
                'content' => $content,
                'category_id' => $category_id,
                'author_id' => $user_id,
                'tags' => $tags,
            ];


            if ($this->wikiModel->addWiki($data)) {
                flash('wiki_message', 'Wiki ajouté avec succès');
                redirect('wikis/index2');
            } else {
                die('Quelque chose s\'est mal passé');
            }
        }


        $wikis = $this->wikiModel->getWikis();
        $this->CategoryModel = $this->model('Category');
        $categories = $this->CategoryModel->getCategories();
        $this->tagModel = $this->model('tag');
        $categoryTags = [];


        foreach ($categories as $category) {
            $tags = $this->tagModel->getTagsByCategory($category->category_id);
            $categoryTags[$category->category_id] = $tags;
        }


        $data = [
            'categories' => $categories,
            'tagsList' => $this->wikiModel->getTags(),
            'categoryTags' => $categoryTags,
            'wikis' => $wikis,
        ];


        $this->view('wikis/add', $data);
        echo "<script> console.log(" . json_encode($data) . ")</script>";
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

        $this->wikiModel = $this->model('Wiki');


        $tags = $this->wikiModel->getTagsByCategory($categoryId);


        echo json_encode($tags);
    }

    public function delete($id)
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if ($this->wikiModel->deleteWiki($id)) {
                flash('wiki_message', 'Wiki Deleted');
                redirect('wikis/index2');
            } else {
                die('Something went wrong');
            }
        } else {

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


            $searchResults = $this->wikiModel->searchWikis($searchTerm);

            header('Content-Type: application/json');
            echo json_encode($searchResults);

            exit;
        }
    }
}
