<?php
class Wiki
{
    private $db;
    public $author_name; 

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getWikis()
    {
        $this->db->query("SELECT wikis.*, categories.category_name, GROUP_CONCAT(tags.tag_name) AS tags
                         FROM wikis
                         LEFT JOIN categories ON wikis.category_id = categories.category_id
                         LEFT JOIN wikitags ON wikis.wiki_id = wikitags.wiki_id
                         LEFT JOIN tags ON wikitags.tag_id = tags.tag_id where archived=0
                         GROUP BY wikis.wiki_id
                         ORDER BY wikis.created_at DESC");
        return $this->db->resultSet();
    }

    // public function addWiki($data) {
    //     // Insertion dans la table des wikis
    //     $this->db->query('INSERT INTO wikis (title, content, category_id) VALUES (:title, :content, :category_id)');
    //     // Liaison des valeurs
    //     $this->db->bind(':title', $data['title']);
    //     $this->db->bind(':content', $data['content']);
    //     $this->db->bind(':category_id', $data['category_id']);
    //     // Exécution de la requête
    //     if ($this->db->execute()) {
    //         $wiki_id = $this->db->lastInsertId();

    //         // Ajout des tags associés au wiki dans la table de liaison (wiki_tags)
    //         // var_dump($data);
    //         foreach ($data['tags'] as $tag_id) {
    //             $this->db->query('INSERT INTO wikitags (wiki_id, tag_id) VALUES (:wiki_id, :tag_id)');
    //             $this->db->bind(':wiki_id', $wiki_id);
    //             $this->db->bind(':tag_id', $tag_id);
    //             $this->db->execute();
    //         }

    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    // ...

    public function addWiki($data)
    {
        $this->db->query('INSERT INTO wikis (title, content, category_id, author_id) VALUES (:title, :content, :category_id, :author_id)');
        // Bind values
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':content', $data['content']);
        $this->db->bind(':category_id', $data['category_id']);
        $this->db->bind(':author_id', $data['author_id']);
    
        // Execute
        if ($this->db->execute()) {
            $wikiId = $this->db->lastInsertId();
    
            // Insert tags
            foreach ($data['tags'] as $tagId) {
                $this->db->query('INSERT INTO wikitags (wiki_id, tag_id) VALUES (:wiki_id, :tag_id)');
                $this->db->bind(':wiki_id', $wikiId);
                $this->db->bind(':tag_id', $tagId);
    
                $this->db->execute();
            }
    
            return true;
        } else {
            return false;
        }
    }
    


    
    


    public function updateWiki($data)
    {
        // Update the main wiki information
        $this->db->query('UPDATE wikis SET title = :title, content = :content, category_id = :category_id WHERE wiki_id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':content', $data['content']);
        $this->db->bind(':category_id', $data['category_id']);

        if ($this->db->execute()) {
            // Delete existing tags for the wiki
            $this->db->query('DELETE FROM wikitags WHERE wiki_id = :id');
            $this->db->bind(':id', $data['id']);
            $this->db->execute();

            // Insert new tags for the wiki
            foreach ($data['tags'] as $tag_id) {
                $this->db->query('INSERT INTO wikitags (wiki_id, tag_id) VALUES (:wiki_id, :tag_id)');
                $this->db->bind(':wiki_id', $data['id']);
                $this->db->bind(':tag_id', $tag_id);
                $this->db->execute();
            }

            return true;
        } else {
            return false;
        }
    }


    public function getWikiById($id)
    {
        $this->db->query('SELECT Wikis.*, Users.username as author_name, Categories.category_name, GROUP_CONCAT(Tags.tag_name) AS tag_ids
        FROM Wikis
        JOIN Users ON Wikis.author_id = Users.user_id
        JOIN Categories ON Wikis.category_id = Categories.category_id
        LEFT JOIN WikiTags ON Wikis.wiki_id = WikiTags.wiki_id
        LEFT JOIN Tags ON WikiTags.tag_id = Tags.tag_id
        WHERE Wikis.wiki_id = :wiki_id
        GROUP BY Wikis.wiki_id
        ORDER BY Wikis.updated_at DESC;');

    $this->db->bind(':wiki_id', $id);

        $row = $this->db->single();


        if (property_exists($row, 'tag_ids')) {
            $row->tags = explode(',', $row->tag_ids);
        } else {
            $row->tags = [];
        }

        return $row;
    }

    

    public function getCategories()
    {
        $this->db->query('SELECT * FROM categories');
        return $this->db->resultSet();
    }

    public function getTags()
    {
        $this->db->query('SELECT * FROM tags');
        return $this->db->resultSet();
    }

    // public function getTotalWikisCount()
    // {
    //     $this->db->query('SELECT COUNT(*) AS totalWikis FROM wikis');
    //     $row = $this->db->single();
    //     return $row->totalWikis;
    // }

    // models/Wiki.php
    public function getTagsByCategory($categoryId)
    {
        $this->db->query('SELECT * FROM tags WHERE category_id = :category_id');
        $this->db->bind(':category_id', $categoryId);

        return $this->db->resultSet();
    }

    public function addTagToWiki($wikiId, $tagId)
    {
        $this->db->query('INSERT INTO wikitags (wiki_id, tag_id) VALUES (:wiki_id, :tag_id)');
        $this->db->bind(':wiki_id', $wikiId);
        $this->db->bind(':tag_id', $tagId);

        return $this->db->execute();
    }

    public function deleteWiki($id)
    {
        // First, delete the associated tags
        $this->db->query('DELETE FROM wikitags WHERE wiki_id = :id');
        $this->db->bind(':id', $id);
        $this->db->execute();

        // Then, delete the wiki
        $this->db->query('DELETE FROM wikis WHERE wiki_id = :id');
        $this->db->bind(':id', $id);

        return $this->db->execute();
    }

    public function archiveWiki($id)
    {
        $this->db->query('UPDATE wikis SET archived = 1 WHERE wiki_id = :id');
        $this->db->bind(':id', $id);

        return $this->db->execute();
    }


    public function getTotalWikisCount()
    {
        $this->db->query('SELECT COUNT(*) AS total FROM wikis');
        return $this->db->single()->total;
    }

    
    public function getWikisByUserId($userId)
    {
    
    
        $this->db->query("SELECT wikis.*, categories.category_name, GROUP_CONCAT(tags.tag_name) AS tags
        FROM wikis
        LEFT JOIN categories ON wikis.category_id = categories.category_id
        LEFT JOIN wikitags ON wikis.wiki_id = wikitags.wiki_id 
        LEFT JOIN tags ON wikitags.tag_id = tags.tag_id
        WHERE archived = 0 AND author_id = :user_id
        GROUP BY wikis.wiki_id 
        ORDER BY wikis.created_at DESC");
    
    $this->db->bind(':user_id', $userId);
    
    
        return $this->db->resultSet();
    }

public function searchWikis($searchTerm)
    {
        $query = "SELECT wikis.*, categories.category_name, GROUP_CONCAT(tags.tag_name) AS tags
                  FROM wikis
                  LEFT JOIN categories ON wikis.category_id = categories.category_id
                  LEFT JOIN wikitags ON wikis.wiki_id = wikitags.wiki_id
                  LEFT JOIN tags ON wikitags.tag_id = tags.tag_id
                  WHERE (wikis.title LIKE :searchTerm OR wikis.content LIKE :searchTerm OR  categories.category_name LIKE :searchTerm OR tags.tag_name  like :searchTerm)
                  AND archived = 0";

        $query .= " GROUP BY wikis.wiki_id";

        $this->db->query($query);
        $this->db->bind(':searchTerm', "%$searchTerm%");


        return $this->db->resultSet();
    }

    // In your Wiki model (Wiki.php)
public function getLastWikiAuthor()
{
    $this->db->query('SELECT users.username FROM wikis
                      JOIN users ON wikis.author_id = users.user_id
                      ORDER BY wikis.created_at DESC
                      LIMIT 1');

    $row = $this->db->single();

    return $row->username;
}



}
