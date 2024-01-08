<?php

class Pages extends Controller
{
    public function __construct()
    {
        // Constructor logic, if needed
    }

    public function index()
    {
        // Fetch tags or data from your model as needed
        $tagsModel = $this->model('Tag');
        $tags = $tagsModel->getTags();

        $data = [
            'tags' => $tags,
            // Add other data as needed
        ];

        $this->view('pages/index', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About Us',
            'description' => 'App to share posts with other users'
        ];

        $this->view('pages/about', $data);
    }
}