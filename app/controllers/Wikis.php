<?php

class Wikis extends Controller
{
    public function index()
    {
        $wikiModel = $this->model('Wiki');

        if ($wikiModel) {
            $wikis = $wikiModel->getAllWikis();

            if ($wikis) {
                $data = [
                    'wikis' => $wikis
                ];

                $this->view('wikis/index', $data);
            } else {
                // Gérer le cas où aucune donnée n'est récupérée du modèle
                echo "No wikis found.";
            }
        } else {
            // Gérer le cas où le modèle n'est pas correctement chargé
            echo "Error loading Wiki model.";
        }
    }
}