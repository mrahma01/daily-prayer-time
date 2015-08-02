<?php

class DatabaseConnection
{
    public function __construct()
    {
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

    }

    public function returnArray($sql)
    {
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                return $row;
            }
        }
        $conn->close();

        return false;
    }
}
