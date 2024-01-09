<?php

class Wiki {
    private $db;
    private $wikiModel;
    public function __construct() {
    $this->db = new Database;
    }

    // Récupérer tous les wikis
    public function getAllWikis() {
        $this->db->query('SELECT * FROM wikis');
        return $this->db->resultSet();
    }

    // Récupérer un wiki par son ID
    public function getWikiById($id) {
        $this->db->query('SELECT * FROM wikis WHERE wiki_id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Ajouter un wiki
    public function addWiki($data) {
        $this->db->query('INSERT INTO wikis (title, content, author_id, category_id, created_at, updated_at, archived) 
                          VALUES (:title, :content, :author_id, :category_id, :created_at, :updated_at, :archived)');
        // Bind values
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':content', $data['content']);
        $this->db->bind(':author_id', $data['author_id']);
        $this->db->bind(':category_id', $data['category_id']);
        $this->db->bind(':created_at', $data['created_at']);
        $this->db->bind(':updated_at', $data['updated_at']);
        $this->db->bind(':archived', $data['archived']);

        // Execute
        return $this->db->execute();
    }

    // Mettre à jour un wiki
    public function updateWiki($data) {
        $this->db->query('UPDATE wikis SET title = :title, content = :content, category_id = :category_id, updated_at = :updated_at, archived = :archived 
                          WHERE wiki_id = :id');
        // Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':content', $data['content']);
        $this->db->bind(':category_id', $data['category_id']);
        $this->db->bind(':updated_at', $data['updated_at']);
        $this->db->bind(':archived', $data['archived']);

        // Execute
        return $this->db->execute();
    }

    // Supprimer un wiki par son ID
    public function deleteWiki($id) {
        $this->db->query('DELETE FROM wikis WHERE wiki_id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }


}

