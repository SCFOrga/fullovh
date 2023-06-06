<?php

class Database
{
    private $host = "by93828-001.privatesql";
    private $db_name = "scf2023";
    private $username = "scf2023";
    private $password = "VDGE462zgrt23";
    private $conn;
    private $port = "35146";


    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";port=" . $this->port, $this->username, $this->password);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}