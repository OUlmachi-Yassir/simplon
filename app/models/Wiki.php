<?php
class Wiki {
    private $db;

    public function __construct()
    {
        $this->db = new Database; // Assuming you have a Database class
    }

    public function addWiki($title, $content, $categoryId)
    {
        $query = "INSERT INTO wiki (title, content, creationDate, categoryId) VALUES (:title, :content, NOW(), :categoryId)";
        $this->db->query($query);
        $this->db->bind(':title', $title);
        $this->db->bind(':content', $content);
        $this->db->bind(':categoryId', $categoryId);

        $this->db->execute();

        return $this->db->lastInsertId();
    }

    public function addWikiTag($wikiId, $tagId)
    {
        $query = "INSERT INTO wikitag (wikiId, tagId) VALUES (:wikiId, :tagId)";
        $this->db->query($query);
        $this->db->bind(':wikiId', $wikiId);
        $this->db->bind(':tagId', $tagId);

        $this->db->execute();
    }
  public function getWikis()
    {
        $this->db->query('SELECT * FROM wiki');
        return $this->db->resultSet();
    }

}