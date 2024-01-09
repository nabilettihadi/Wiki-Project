<?php
class Tags extends Controller
{
    public $tagModel;
    public $categoryModel;

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->tagModel = $this->model('Tag');
        $this->categoryModel = $this->model('Category');
    }

    public function index()
    {
        $categories = $this->categoryModel->getCategories();
        $tags = $this->tagModel->getTags();

        $data = [
            'tags' => $tags,
            'categories' => $categories
        ];

        $this->view('tags/index', $data);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => trim($_POST['title']),
                'content' => trim($_POST['content']),
                'category_id' => $_POST['category_id'],
                'tags' => $this->tagModel->getTagsByCategory($_POST['category_id']),
                'title_err' => '',
                'content_err' => ''
            ];

            if (empty($data['title_err']) && empty($data['content_err'])) {
                // Enregistrez votre Wiki et ses tags ici
                if ($this->wikiModel->addWiki($data)) {
                    flash('wiki_message', 'Wiki Created');
                    redirect('wikis');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Affichez la vue avec les erreurs
                $this->view('wikis/create', $data);
            }
        } else {
            // Chargez les catégories pour le formulaire
            $data = [
                'title' => '',
                'content' => '',
                'category_id' => '',
                'categories' => $this->categoryModel->getCategories(),
                'tags' => [] // Initialisez les tags à une liste vide pour éviter les erreurs dans la vue
            ];
    
            $this->view('wikis/create', $data);
        }
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->tagModel->deleteTag($id)) {
                flash('tag_message', 'Tag Deleted');
                redirect('tags');
            } else {
                die('Something went wrong');
            }
        } else {
            redirect('tags');
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'tag_name' => trim($_POST['tag_name']),
                'category_id' => $_POST['category_id'],
                'tag_name_err' => ''
            ];

            if (empty($data['tag_name'])) {
                $data['tag_name_err'] = 'Please enter a name';
            }

            if (empty($data['tag_name_err'])) {
                if ($this->tagModel->updateTag($data)) {
                    flash('tag_message', 'Tag Updated');
                    redirect('tags');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('tags/edit', $data);
            }
        } else {
            $tag = $this->tagModel->getTagById($id);

            if (!$tag) {
                redirect('tags');
            }

            // Vérifier si l'utilisateur a les droits nécessaires
            if (!userHasRights($tag->user_id)) {
                redirect('tags');
            }

            $data = [
                'id' => $id,
                'tag_name' => $tag->tag_name,
                'tag_name_err' => '',
                'categories' => $this->categoryModel->getCategories()
            ];

            $this->view('tags/edit', $data);
        }
    }

    public function filterByCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $categoryId = isset($_POST['category_id']) ? $_POST['category_id'] : null;

            $tags = $this->tagModel->getTagsByCategory($categoryId);

            $data = [
                'tags' => $tags
            ];

            echo json_encode($data);
        } else {
            redirect('tags');
        }
    }

    // Ajouter une fonction pour vérifier les droits de l'utilisateur
    private function userHasRights($userId)
    {
        // Vérifier si l'utilisateur a les droits nécessaires
        return ($userId == $_SESSION['user_id']);
    }
}
?>
