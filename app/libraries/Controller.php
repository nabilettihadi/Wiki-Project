<?php
/*
 * Base Controller
 * Loads the models and views
 */
class Controller {
    // Load model
    public function model($model)
    {
        // Require model file
        $modelPath = realpath('../app/models/' . $model . '.php');
        if ($modelPath) {
            require_once $modelPath;

            // Instantiate model
            return new $model();
        } else {
            // Model file does not exist
            die('Model does not exist');
        }
    }

    // Load view
    public function view($view, $data = [])
    {
        // Check for view file
        $viewPath = realpath('../app/views/' . $view . '.php');
        if ($viewPath) {
            require_once $viewPath;
        } else {
            // View file does not exist
            die('View does not exist');
        }
    }
}