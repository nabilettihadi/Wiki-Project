<?php
class Tag
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getTags()
    {
        $this->db->query('SELECT tags.tag_id as tagId,
                                tags.tag_name as tagName,
                                categories.category_id as categoryId,
                                categories.category_name as categoryName
                            FROM tags
                            LEFT JOIN categories
                            ON tags.category_id = categories.category_id
                            ORDER BY tags.tag_id DESC');

        $results = $this->db->resultSet();

        return $results;
    }

    public function getAllTags()
    {
        $this->db->query('SELECT * FROM tags');
        return $this->db->resultSet();
    }

    public function addTag($data)
    {
        $this->db->query('INSERT INTO tags (tag_name, category_id) VALUES(:tag_name, :category_id)');
        $this->db->bind(':tag_name', $data['tag_name']);
        $this->db->bind(':category_id', $data['category_id']);

        return $this->db->execute();
    }

    public function deleteTag($id)
    {
        $this->db->query('DELETE FROM tags WHERE tag_id = :tag_id');
        $this->db->bind(':tag_id', $id);

        return $this->db->execute();
    }

    public function updateTag($data)
    {
        $this->db->query('UPDATE tags SET tag_name = :tag_name, category_id = :category_id WHERE tag_id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':tag_name', $data['tag_name']);
        $this->db->bind(':category_id', $data['category_id']);

        return $this->db->execute();
    }

    public function getTagById($id)
    {
        $this->db->query('SELECT * FROM tags WHERE tag_id = :id');
        $this->db->bind(':id', $id);

        return $this->db->single();
    }

    public function getTagsByCategory($categoryId = null)
    {
        $sql = 'SELECT tags.tag_id as tagId,
                        tags.tag_name as tagName,
                        categories.category_id as categoryId,
                        categories.category_name as categoryName
                FROM tags
                LEFT JOIN categories
                ON tags.category_id = categories.category_id';

if ($categoryId !== null && is_numeric($categoryId)) {
    $sql .= ' WHERE tags.category_id = :category_id';
    $this->db->bind(':category_id', $categoryId);}

        $this->db->query($sql);

        return $this->db->resultSet();
    }
}
?>
