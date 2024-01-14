<?php
class Tags extends Controller
{
    public $tagModel;
    public $categoryModel;

    public $wikiModel;

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->tagModel = $this->model('Tag');
        $this->categoryModel = $this->model('Category');
        $this->wikiModel = $this->model('Wiki');
    }

    public function index()
    {
        $categories = $this->categoryModel->getCategories();
        $totalCategories = $this->categoryModel->getTotalCategories();
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

    public function index2()
    {

        $tags = $this->tagModel->getTags();
        $totalTags = $this->tagModel->getTotalTags();

        $data = [
            'tags' => $tags,
            'totalTags' => $totalTags,
        ];

        $this->view('tags/index', $data);

    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'tag_name' => trim($_POST['tag_name']),
                'category_id' => $_POST['category_id'],
                'title_err' => ''
            ];

            if (empty($data['tag_name'])) {
                $data['title_err'] = 'Please enter a name';
                redirect('tags/add');

            } else {
                // Check if the tag already exists
                if ($this->tagModel->tagExists($data['tag_name'])) {
                    $data['title_err'] = 'Tag already exists';
                    redirect('tags/add');

                }
            }

            if (empty($data['title_err'])) {
                if ($this->tagModel->addTag($data)) {
                    flash('tag_message', 'Tag Added');
                    redirect('tags/index2');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('tags/add', $data);
            }
        } else {
            $data = [
                'tag_name' => '',
                'categories' => $this->categoryModel->getCategories()
            ];

            $this->view('tags/add', $data);
        }
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->tagModel->deleteTag($id)) {
                flash('tag_message', 'Tag Deleted');
                redirect('tags/index2');
            } else {
                die('Something went wrong');
            }
        } else {
            redirect('tags');
        }
    }
    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'id' => $id,
                'tag_name' => trim($_POST['tag_name']),
                'tag_name_err' => ''
            ];

            if (empty($data['tag_name'])) {
                $data['tag_name_err'] = 'Please enter a tag name';
            }

            if (empty($data['tag_name_err'])) {
                if ($this->tagModel->updateTag($data)) {
                    flash('tag_message', 'Tag Updated');
                    redirect('tags/index2');
                } else {
                    die('Something went wrong');
                }
            } else {
                $data['tags'] = $this->tagModel->getTags();
                $this->view('tags/index', $data);
            }
        } else {
            $tag = $this->tagModel->getTagById($id);

            if (!$tag) {
                redirect('tags');
            }

            if ($tag->category_id != $_SESSION['user_id']) {
                redirect('tags/index2');
            }

            $data = [
                'id' => $id,
                'tag_name' => $tag->tagName,
                'tag_name_err' => ''
            ];

            $this->view('tags/index', $data);
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
}