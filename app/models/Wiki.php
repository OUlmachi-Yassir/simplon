<?php
class Wiki {
    private $db;

    public function __construct()
    {
        $this->db = new Database; // Assuming you have a Database class
    }

    // Inside your Wiki model
public function addWiki($title, $content, $creationDate, $categoryId)
{
    // Assuming you have started the session before
    $authorId = $_SESSION['user_id'];

    // Your database insertion query
    $this->db->query('INSERT INTO wiki (title, content, creationDate, authorId, categoryId) VALUES (:title, :content, :creationDate, :authorId, :categoryId)');

    // Bind parameters
    $this->db->bind(':title', $title);
    $this->db->bind(':content', $content);
    $this->db->bind(':creationDate', $creationDate);
    $this->db->bind(':authorId', $authorId);
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
        $this->db->query('SELECT wiki.*, category.name AS categoryName, GROUP_CONCAT(tag.name) AS tagNames
        FROM wiki
        INNER JOIN category ON wiki.categoryId = category.categoryId
        LEFT JOIN wikitag ON wiki.wikiId = wikitag.wikiId
        LEFT JOIN tag ON wikitag.tagId = tag.tagId
        WHERE wiki.isArchived = 0
        GROUP BY wiki.wikiId');
        return $this->db->resultSet();
    }


    public function updateWiki($wikiId, $title, $content, $categoryId)
    {
        $this->db->query('UPDATE wiki SET title = :title, content = :content, categoryId = :categoryId WHERE wikiId = :wikiId');
        $this->db->bind(':wikiId', $wikiId);
        $this->db->bind(':title', $title);
        $this->db->bind(':content', $content);
        $this->db->bind(':categoryId', $categoryId);

        return $this->db->execute();
    }


   public function getWikiById($wikiId)
    {
        $this->db->query('SELECT * FROM wiki WHERE wikiId = :wikiId');
        $this->db->bind(':wikiId', $wikiId);

        return $this->db->single(); // Assuming you have a method like `single()` to fetch a single result
    }


    public function getWikisByAuthor($authorId)
{
    $this->db->query('SELECT wiki.*, category.name AS categoryName, GROUP_CONCAT(tag.name) AS tagNames
        FROM wiki
        INNER JOIN category ON wiki.categoryId = category.categoryId
        LEFT JOIN wikitag ON wiki.wikiId = wikitag.wikiId
        LEFT JOIN tag ON wikitag.tagId = tag.tagId
        WHERE wiki.isArchived = 0 AND wiki.authorId = :authorId
        GROUP BY wiki.wikiId');
    
    $this->db->bind(':authorId', $authorId);

    return $this->db->resultSet();
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


public function getTotalWikisCount()
{
    $this->db->query('SELECT COUNT(*) AS total FROM wiki');
    return $this->db->single()->total;
}


public function searchWikisByTitle($searchQuery)
{

    // Use a prepared statement to prevent SQL injection
    $this->db->query('SELECT wiki.*, category.name, GROUP_CONCAT(tag.name) AS tags
              FROM wiki
              LEFT JOIN category ON wiki.categoryId = category.categoryId
              LEFT JOIN wikitag ON wiki.wikiId = wikitag.wikiId
              LEFT JOIN tag ON wikitag.tagId = tag.tagId
              WHERE (wiki.title LIKE :searchTerm OR wiki.content LIKE :searchTerm OR category.name LIKE :searchTerm OR tag.name LIKE :searchTerm)
              AND isArchived = 0
              GROUP BY wiki.wikiId'); // Group by wikiId to avoid duplicate rows

    $this->db->bind(':searchTerm', '%' . $searchQuery . '%'); // Use % for partial matching

    // return $this->db->resultSet();
    // // Use a prepared statement to prevent SQL injection
    // $this->db->query('SELECT * FROM wiki WHERE title LIKE :searchQuery');
    // $this->db->bind(':searchQuery', '%' . $searchQuery . '%'); // Use % for partial matching

    return $this->db->resultSet();
}


public function searchWikis($searchQuery)
{
    // Use a prepared statement to prevent SQL injection
    $this->db->query('SELECT wiki.*, category.name, GROUP_CONCAT(tag.name) AS tags
              FROM wiki
              LEFT JOIN category ON wiki.categoryId = category.categoryId
              LEFT JOIN wikitag ON wiki.wikiId = wikitag.wikiId
              LEFT JOIN tag ON wikitag.tagId = tag.tagId
              WHERE (wiki.title LIKE :searchTerm OR wiki.content LIKE :searchTerm OR category.name LIKE :searchTerm OR tag.name LIKE :searchTerm)
              AND isArchived = 0
              GROUP BY wiki.wikiId'); // Group by wikiId to avoid duplicate rows

    $this->db->bind(':searchTerm', '%' . $searchQuery . '%'); // Use % for partial matching

    return $this->db->resultSet();
}

}