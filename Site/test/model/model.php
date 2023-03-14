<?php
    function db_connect(){
        try {
                $db = new PDO('mysql:host=localhost;dbname=scf2023;charset=utf8', 'user', 'eclipse');
            }
            catch(Exception $e)
            {
                    die('Erreur : ' .$e->getMessage());
            }
            return $db;
    }
    function get_data() {
        $db = db_connect();
        return $db->query('SELECT * FROM fares; WHERE 1');
    }
