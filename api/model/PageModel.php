<?php
class PageModel
{
    private $db;

    public function __construct()
    {
        $this->db = new database();
    }

    // Fetch all pages from the table
    public function getAllPages()
    {
        $query = "SELECT * FROM page";
        return $this->db->select($query);
    }

    // Delete a specific page by its PageID
    public function deletePage($pageID)
    {
        $query = "DELETE FROM page WHERE PageID = ?";
        $params = ['i', $pageID];
        return $this->db->insert($query, $params); // Assuming there's no 'delete' method, and 'insert' method is being used for delete operations as in your given sample
    }

    // Add a new page
    public function addPage($title, $body, $active, $priority)
    {
        $query = "INSERT INTO page (Title, Body, Active, Priority) VALUES (?, ?, ?, ?)";
        $params = ['ssii', $title, $body, $active, $priority];
        return $this->db->insert($query, $params);
    }
}
