<?php
class InternModel
{
    private $db;

    public function __construct()
    {
        $this->db = new database();
    }

    public function getInterns($limit)
    {
        $query = "SELECT * FROM interns LIMIT ?";
        $params = ['i', $limit];
        return $this->db->select($query, $params);
    }
    public function addIntern($data)
    {
        // Hash the password
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        $query = "INSERT INTO interns (FullName, Password, GradDate, Email, Mobile, University, Major, CV) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $params = [
            'sssssssb',
            &$data['fName'],
            &$hashedPassword,  // Use the hashed password here
            &$data['GradDate'],
            &$data['email'],
            &$data['mobile'],
            &$data['university'],
            &$data['major'],
            &$data['cvUpload']
        ];

        try {
            return $this->db->insert($query, $params);
        } catch (Exception $e) {
            if ($e->getCode() == 1062) {
                // Duplicate email entry
                throw new Exception("Email is already taken.");
            } else {
                // Some other error occurred, so just rethrow the original exception
                throw $e;
            }
        }
    }
    public function InternProgReg($internID, $programID)
    {
        $query = "INSERT INTO internprog (Intern_id, Program_id) VALUES (?, ?)";

        $params = [
            'ii',  // 'i' denotes INTEGER type in mysqli prepared statements
            &$internID,
            &$programID
        ];

        $result = $this->db->insert($query, $params);

        // If the insert was successful, increment the CurrentCapacity in the program table
        if ($result) {
            // Manually updating the CurrentCapacity
            $queryUpdate = "UPDATE program SET CurrentCapacity = CurrentCapacity + 1 WHERE ProgID = ?";
            $paramsUpdate = ['i', &$programID];

            $updateResult = $this->db->update($queryUpdate, $paramsUpdate);
            if (!$updateResult) {
                // Handle the error case where the update failed
                // For instance, you can log an error or throw an exception
            }

            return true;
        }

        return false;  // Return false if the insert didn't succeed.
    }


    public function ProgRegStatus($internID, $programID)
    {
        $query = "SELECT COUNT(*) as count FROM internprog WHERE Intern_id = ? AND Program_id = ?";
        $params = [
            'ii',
            &$internID,
            &$programID
        ];

        $result = $this->db->select($query, $params); // Assuming 'query' is a method in your DB class that fetches data

        if ($result && $result[0]['count'] > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function getInternProgramAssociations()
    {
        $query = "
        SELECT i.InternID, p.Title as program_title
        FROM interns i
        JOIN internprog ip ON i.InternID = ip.Intern_id  
        JOIN program p ON ip.Program_id = p.ProgID
        ORDER BY i.InternID
        ";

        $results = $this->db->select($query);  // Since you don't need to pass any params for this query

        $associations = [];
        foreach ($results as $row) {
            if (!isset($associations[$row['InternID']])) {
                $associations[$row['InternID']] = [];
            }
            $associations[$row['InternID']][] = $row['program_title'];
        }

        return $associations;
    }
    public function deleteInternByID($internID)
    {
        // Just delete the intern record, associated internprog entries will be deleted automatically
        /*$query = "DELETE FROM interns WHERE InternID = ?";
        $params = ['i', &$internID];
        $result = $this->db->insert($query, $params);

        if ($result) {
            return true;  // Delete was successful
        } else {
            return false;  // There was an error
        }*/
        try {
            $deleteRelatedRowsQuery = "DELETE FROM internprog WHERE Intern_id  = ?";
            $deleteRelatedRowsParams = ['i', &$internID];
    
            // Execute the query to delete related rows
            $this->db->insert($deleteRelatedRowsQuery, $deleteRelatedRowsParams);
            $query = "DELETE FROM interns WHERE InternID = ?";
            $params = ['i', &$internID];
    
            $result = $this->db->insert($query, $params);
    
            if ($result === false) {
                // Error occurred during deletion
                return false;
            }
    
            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function getInternsByProgramID($programID)
    {
        // This query will fetch employee details for a given program ID
        $query = "SELECT e.InternID , e.FullName
              FROM interns e
              JOIN internprog ep ON e.InternID = ep.Intern_id 
              WHERE ep.Program_ID = ?";
        $params = ['i', &$programID];

        return $this->db->select($query, $params);
    }
    // Later on, you can add more methods to fetch specific intern details, 
    // add a new intern, update details, etc.
}
