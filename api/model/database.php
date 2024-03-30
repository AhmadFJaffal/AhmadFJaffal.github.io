<?php
class database
{
    protected $connection = null;
    public function __construct()
    {
        try {
            $this->connection = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE_NAME, DB_PORT);

            if (mysqli_connect_errno()) {
                throw new Exception("Could not connect to database.");
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function select($query = "", $params = [])
    {
        try {
            $stmt = $this->executeStatement($query, $params);
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $result;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return false;
    }
    private function executeStatement($query, $params)
    {
        $stmt = $this->connection->prepare($query);

        if ($stmt === false) {
            throw new Exception("Failed to prepare the statement: " . $this->connection->error);
        }

        // If there are parameters to bind, then bind them
        if (!empty($params)) {
            // Extract the types from the $params array
            $types = array_shift($params);

            // Merge the types and parameters so that the array structure becomes compatible
            // with the call_user_func_array function
            $bindArgs = array_merge([$types], $params);

            // Use references since bind_param expects them
            $bindArgsRef = [];
            foreach ($bindArgs as $key => $value) {
                $bindArgsRef[$key] = &$bindArgs[$key];
            }

            // Use call_user_func_array to bind parameters
            call_user_func_array([$stmt, 'bind_param'], $bindArgsRef);
        }

        if (!$stmt->execute()) {
            throw new Exception("Failed to execute the statement: " . $stmt->error);
        }

        return $stmt;
    }


    public function insert($query, $params = [])
    {
        try {
            $stmt = $this->executeStatement($query, $params);
            $affectedRows = $stmt->affected_rows;
            $stmt->close();

            return $affectedRows > 0;  // Will return true if a row was inserted, otherwise false
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function update($query, $params = [])
    {
        try {
            $stmt = $this->executeStatement($query, $params);
            $affectedRows = $stmt->affected_rows;
            $stmt->close();

            return $affectedRows > 0;  // Will return true if one or more rows were updated, otherwise false
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
