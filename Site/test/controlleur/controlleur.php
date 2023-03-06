<?php
include_once "../db/database.php";

function home_page(){
        include_once "control.php";
        $database = new database();
        $db = $database->get_connexion();
        $fares = new Fares($db);
        $stmt = $fares->readAll();
}