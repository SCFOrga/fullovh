<?php
class fares
{

    // database connection and table name
    private $conn;
    private $table_name = "fares";

    // object properties
    public $gaz;
    public $electricite;
    public $thermique;
    public $chauffage;
    public $eau;


    public function __construct($db)
    {
        $this->conn = $db;
    }

    function readAll()
    {
        $query = "SELECT
                    *
                FROM
                  fares  " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}