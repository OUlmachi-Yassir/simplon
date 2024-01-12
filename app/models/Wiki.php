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
        $this->db->query('SELECT * FROM wiki WHERE isArchived=0');
        return $this->db->resultSet();
    }
   public function getWikiById($wikiId)
    {
        $this->db->query('SELECT * FROM wiki WHERE wikiId = :wikiId');
        $this->db->bind(':wikiId', $wikiId);

        return $this->db->single(); // Assuming you have a method like `single()` to fetch a single result
    }

    public function archiveWiki($wikiId)
{
    $query = "UPDATE wiki SET isArchived = 1 WHERE wikiId = :wikiId";
    $this->db->query($query);
    $this->db->bind(':wikiId', $wikiId);
    $this->db->execute();
}


    public function deleteWiki($wikiId)
{
    $query = "DELETE FROM wiki WHERE wikiId = :wikiId";
    $this->db->query($query);
    $this->db->bind(':wikiId', $wikiId);

    $this->db->execute();
}

public function editWiki($wikiId, $title, $content, $categoryId)
{
    $query = "UPDATE wiki SET title = :title, content = :content, categoryId = :categoryId WHERE wikiId = :wikiId";
    $this->db->query($query);
    $this->db->bind(':wikiId', $wikiId);
    $this->db->bind(':title', $title);
    $this->db->bind(':content', $content);
    $this->db->bind(':categoryId', $categoryId);

    $this->db->execute();
}



}