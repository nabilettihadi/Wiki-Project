<?php

class Wikis extends Controller {
    private $wikiModel;
    private $categoryModel;  // Add this line

    public function __construct() {
        $this->wikiModel = $this->model('Wiki');
        $this->categoryModel = $this->model('Category');  // Add this line
    }
    

    // Page d'accueil des wikis
    public function index() {
        // Récupérer tous les wikis
        $wikis = $this->wikiModel->getAllWikis();

        // Charger la vue
        $this->view('wikis/index', ['wikis' => $wikis]);
    }

    // Page de création d'un wiki
    public function create() {

        // Vérifier si l'utilisateur est connecté
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        // Get categories from the database
        $categories = $this->categoryModel->getCategories();

        // Vérifier si le formulaire est soumis
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Debugging
            var_dump($_POST);
            
            // Sanitization et validation des données du formulaire
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            // Debugging
            var_dump($_POST);
        
            $data = [
                'title' => trim($_POST['title']),
                'content' => trim($_POST['content']),
                'author_id' => $_SESSION['user_id'],
                'category_id' => trim($_POST['category_id']),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'archived' => 0,
            ];
        
            // Debugging
            var_dump($data);

            // Ajouter le wiki à la base de données
            if ($this->wikiModel->addWiki($data)) {
                // Rediriger vers la page d'accueil des wikis
                redirect('wikis/index');
            } else {
                die('Something went wrong');
            }
        } else {
            // Charger la vue du formulaire de création
            $this->view('wikis/create', ['categories' => $categories]);
        }
    }

    // Page d'édition d'un wiki
    public function edit($id) {
        // Vérifier si l'utilisateur est connecté
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        // Vérifier si le wiki existe
        $wiki = $this->wikiModel->getWikiById($id);
        if (!$wiki) {
            // Si le wiki n'existe pas, rediriger vers la page d'accueil des wikis
            redirect('wikis/index');
        }
        function isAdmin() {
            // Check if the user is logged in and has the 'admin' role
            return (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin');
        }
        // Vérifier si l'utilisateur est l'auteur du wiki ou un administrateur
        if ($wiki->author_id != $_SESSION['user_id'] && !isAdmin()) {
            // Si l'utilisateur n'est pas l'auteur ni un administrateur, rediriger vers la page d'accueil des wikis
            redirect('wikis/index');
        }
        $categories = $this->categoryModel->getCategories();
        // Vérifier si le formulaire est soumis
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitization et validation des données du formulaire
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'content' => trim($_POST['content']),
                'category_id' => trim($_POST['category_id']),
                'updated_at' => date('Y-m-d H:i:s'),
                'archived' => 0, // Réinitialiser l'état d'archivage lors de la modification
            ];

            // Mettre à jour le wiki dans la base de données
            if ($this->wikiModel->updateWiki($data)) {
                // Rediriger vers la page d'accueil des wikis
                redirect('wikis/index');
            } else {
                die('Something went wrong');
            }
        } else {
            // Charger la vue du formulaire d'édition
            $this->view('wikis/edit', ['wiki' => $wiki]);
        }
    }

    // Page de suppression d'un wiki
    public function delete($id) {
        // Vérifier si l'utilisateur est connecté
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        // Vérifier si le wiki existe
        $wiki = $this->wikiModel->getWikiById($id);
        if (!$wiki) {
            // Si le wiki n'existe pas, rediriger vers la page d'accueil des wikis
            redirect('wikis/index');
        }

        // Vérifier si l'utilisateur est l'auteur du wiki ou un administrateur
        if ($wiki->author_id != $_SESSION['user_id'] && !isAdmin()) {
            // Si l'utilisateur n'est pas l'auteur ni un administrateur, rediriger vers la page d'accueil des wikis
            redirect('wikis/index');
        }

        // Vérifier si le formulaire de suppression est soumis
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Supprimer le wiki de la base de données
            if ($this->wikiModel->deleteWiki($id)) {
                // Rediriger vers la page d'accueil des wikis
                redirect('wikis/index');
            } else {
                die('Something went wrong');
            }
        } else {
            // Charger la vue de confirmation de suppression
            $this->view('wikis/delete', ['wiki' => $wiki]);
        }
    }

   
}