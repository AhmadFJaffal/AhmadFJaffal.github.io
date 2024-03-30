<?php
class UserModel
{
    private $db;

    public function __construct()
    {
        $this->db = new database();
    }
    public function checkEmployee($email, $password)
    {
        $query = "SELECT pass FROM employee WHERE email = ?";
        $params = ['s', $email];
        $result = $this->db->select($query, $params);

        if (!empty($result) && password_verify($password, $result[0]['pass'])) {
            return true;
        }
        return false;
    }


    public function checkIntern($email, $password)
    {
        $query = "SELECT Password FROM interns WHERE Email = ?";
        $params = ['s', $email];
        $result = $this->db->select($query, $params);

        if (!empty($result) && password_verify($password, $result[0]['Password'])) {
            return true;
        }
        return false;
    }
    public function getInternInfo($email)
    {
        $query = "SELECT InternID ,FullName, Email , Mobile, University, GradDate , Major FROM interns WHERE Email = ?";
        $params = ['s', $email];
        $result = $this->db->select($query, $params);

        if (!empty($result)) {
            return [
                'InternID' => $result[0]['InternID'],
                'FullName' => $result[0]['FullName'],
                'Email' => $result[0]['Email'],
                'Mobile' => $result[0]['Mobile'],
                'GradDate' => $result[0]['GradDate'],
                'University' => $result[0]['University'],
                'Major' => $result[0]['Major']
            ];
        }
        return false;
    }
    public function getEmpInfo($email)
    {
        $query = "SELECT EmpID, S_Admin, Fname FROM employee WHERE email = ?";
        $params = ['s', $email];
        $result = $this->db->select($query, $params);

        if (!empty($result) && isset($result[0]['S_Admin'])) {
            return [
                'isSuperAdmin' => $result[0]['S_Admin'] == 1,  // Returns true if the employee is a super admin, false otherwise
                'EmpName' => $result[0]['Fname'],
                'EmpID' => $result[0]['EmpID']
            ];
        }
        return false;
    }
    public function getEmployees($limit)
    {
        $query = "SELECT * FROM employee LIMIT ?";
        $params = ['i', $limit];
        return $this->db->select($query, $params);
    }
    public function deleteEmpByID($EmpID)
    {
        // Just delete the intern record, associated internprog entries will be deleted automatically
        $query = "DELETE FROM employee WHERE EmpID = ?";
        $params = ['i', &$EmpID];
        $result = $this->db->insert($query, $params);

        if ($result) {
            return true;  // Delete was successful
        } else {
            return false;  // There was an error
        }
    }
    public function addEmployee($data)
    {
        // Hash the password
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        $query = "INSERT INTO employee (Fname, email, pass, Role, Major, CreationDate) 
              VALUES (?, ?, ?, ?, ?, ?)";

        $params = [
            'ssssss',
            &$data['fName'],
            &$data['email'],
            &$hashedPassword,  // Use the hashed password here
            &$data['role'],
            &$data['major'],
            &$data['CreationDate'],
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
    public function getEmployeePrograms($employeeId)
    {
        $query = "
        SELECT p.Title
        FROM empprog AS ep
        JOIN program AS p ON ep.Program_ID  = p.ProgID
        WHERE ep.EmployeeID  = ?
    ";

        $params = ['i', &$employeeId];
        $result = $this->db->select($query, $params);

        $programTitles = [];

        foreach ($result as $row) {
            $programTitles[] = $row['Title'];
        }

        return $programTitles;
    }
}
