<?php

class database
{
    private $host = "localhost";
    private $dbname = "scf2023";
    private $username = "scf2023";
    private $password = "VDGE462zgrt23";
    private $conn;

    public function get_connexion()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" .this->host .";dbname=" .this->dbname , $this->username, this->password);
        } catch (PDOException $exception){
            echo "connexion error" .$exception->getMessage();
        }
        return this->conn;
}
}
