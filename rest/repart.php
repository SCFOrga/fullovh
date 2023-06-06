<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");

include_once 'database.php';
include_once 'donnees.php';

// Je souhaite faire un programme qui prend en entrée une table et qui fait une requete SQL en rapport avec cette table

$database = new Database();
$db = $database->getConnection();
$table = $_GET['table'];
$data = $_GET['data'];
$donnees = new Donnees($db, 0, 0, 0, 0, 0, 0);

if(!$donnees->repart($table, $data))
{
    http_response_code(503);
    echo json_encode(array("message" => "Erreur !"));
} else
{
    http_response_code(201);
    echo json_encode(array("message" => "Repartition effectuée !" ));
}

