<?php
class LookupModel
{
    private $db;

    public function __construct()
    {
        $this->db = new database();
    }
    // lookup info
    public function addLookupInfo($name, $employeeID)
    {
        $query = "INSERT INTO lookupinfo (name, EmployeeID) VALUES (?, ?)";
        $params = ['ss', $name, $employeeID];
        return $this->db->insert($query, $params);
    }
    public function getLookupInfoByCode($infoCode)
    {
        $query = "SELECT * FROM lookupinfo WHERE InfoCode = ?";
        $params = ['i', $infoCode];
        return $this->db->select($query, $params);
    }
    public function getAllLookupInfos()
    {
        $query = "SELECT * FROM lookupinfo";
        return $this->db->select($query);
    }
    public function updateLookupInfo($infoCode, $name, $employeeID)
    {
        $query = "UPDATE lookupinfo SET name = ?, EmployeeID = ? WHERE InfoCode = ?";
        $params = ['ssi', $name, $employeeID, $infoCode];
        return $this->db->update($query, $params);
    }
    public function deleteLookupInfo($infoCode)
    {
        $query = "DELETE FROM lookupinfo WHERE InfoCode = ?";
        $params = ['i', $infoCode];
        return $this->db->insert($query, $params);
    }

    // lookup items

    public function addLookupItem($name, $parentID, $priority)
    {
        $query = "INSERT INTO lookupitem (Name, ParentID, Priority) VALUES (?, ?, ?)";
        $params = ['sii', $name, $parentID, $priority];
        return $this->db->insert($query, $params);
    }
    public function getLookupItemByCode($itemCode)
    {
        $query = "SELECT * FROM lookupitem WHERE ItemCode = ?";
        $params = ['i', $itemCode];
        return $this->db->select($query, $params);
    }
    public function getAllLookupItems()
    {
        $query = "SELECT * FROM lookupitem";
        return $this->db->select($query);
    }

    public function updateLookupItem($itemCode, $name, $parentID, $priority)
    {
        $query = "UPDATE lookupitem SET Name = ?, ParentID = ?, Priority = ? WHERE ItemCode = ?";
        $params = ['siii', $name, $parentID, $priority,$itemCode];
        return $this->db->update($query, $params);
    }
    public function deleteLookupItem($itemCode)
{
    $query = "DELETE FROM lookupitem WHERE ItemCode = ?";
    $params = ['i', $itemCode];
    return $this->db->insert($query, $params); // Assuming there's a 'delete' method in your 'database' class
}

}
