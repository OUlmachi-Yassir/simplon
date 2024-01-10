<?php
class Wiki {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

   // app/models/Wiki.php
     public function addWiki($title, $content, $categoryId, $tags)
    {
    // Insert the wiki
    $this->db->query('INSERT INTO wiki (title, content, categoryId) VALUES (:title, :content, :categoryId)');
    $this->db->bind(':title', $title);
    $this->db->bind(':content', $content);
    $this->db->bind(':categoryId', $categoryId);

    if (!$this->db->execute()) {
        return false;
    }

    // Get the last inserted wiki ID
    $wikiId = $this->db->lastInsertId();

    // Associate tags with the wiki
    foreach ($tags as $tagId) {
        $this->db->query('INSERT INTO wikitag (wikiId, tagId) VALUES (:wikiId, :tagId)');
        $this->db->bind(':wikiId', $wikiId);
        $this->db->bind(':tagId', $tagId);
        $this->db->execute();
    }

    return true;
  }

  public function getWikis()
    {
        $this->db->query('SELECT * FROM wiki');
        return $this->db->resultSet();
    }

}