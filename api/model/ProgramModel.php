<?php
class ProgramModel
{
    private $db;

    public function __construct()
    {
        $this->db = new database();  // Create a new instance of your DB handler class.
    }

    public function getPrograms($limit = 10)
    {
        $query = "SELECT * FROM program LIMIT ?";
        $params = ['i', &$limit];
        $result = $this->db->select($query, $params);
        return $result;
    }
    public function getProgramDetails($programID)
    {
        $query = "SELECT * FROM program WHERE ProgID = ?";
        $params = ['i', &$programID]; // 'i' indicates an integer parameter
        $result = $this->db->select($query, $params);

        if (count($result) === 0) return null; // No records found

        return $result[0];  // Return the first (and expected only) result
    }
    public function deleteProgByID($ProgID)
    {
        // Just delete the intern record, associated internprog entries will be deleted automatically
        $query = "DELETE FROM program WHERE ProgID = ?";
        $params = ['i', &$ProgID];
        $result = $this->db->insert($query, $params);

        if ($result) {
            return true;  // Delete was successful
        } else {
            return false;  // There was an error
        }
    }
    public function addProgram($data)
    {
        $query = "INSERT INTO program (Title, Description, StartDate, EndDate, MaxCapacity, CurrentCapacity, ClassCode, ExamLink) 
          VALUES (?,?, ?, ?, ?, ?, ?, ?)";

        $params = [
            'ssssiiss',   // Corresponding data types for each field
            &$data['title'],
            &$data['description'],
            &$data['startDate'],
            &$data['endDate'],
            &$data['maxCapacity'],
            &$data['currentCapacity'],
            &$data['classCode'],
            &$data['examLink']
        ];

        try {
            return $this->db->insert($query, $params);
        } catch (Exception $e) {
            if ($e->getCode() == 1062) {
                // Handle duplicate entry, if applicable (e.g., for a unique column)
                throw new Exception("Duplicate entry detected.");
            } else {
                // Some other error occurred, so just rethrow the original exception
                throw $e;
            }
        }
    }
    public function assignEmployeeToProgram($empID, $programID)
    {
        $query = "INSERT INTO empprog (EmployeeID , Program_ID) VALUES (?, ?)";
        $params = ['ii', &$empID, &$programID];

        try {
            return $this->db->insert($query, $params);
        } catch (Exception $e) {
            if ($e->getCode() == 1062) {
                throw new Exception("The employee is already assigned to this program.");
            } else {
                throw $e;
            }
        }
    }
    public function getEmployeesByProgramID($programID)
    {
        // This query will fetch employee details for a given program ID
        $query = "SELECT e.EmpID, e.Fname
              FROM employee e
              JOIN empprog ep ON e.EmpID = ep.EmployeeID
              WHERE ep.Program_ID = ?";
        $params = ['i', &$programID];

        return $this->db->select($query, $params);
    }
    
}
