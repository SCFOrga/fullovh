<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");

include_once 'database.php';
include_once 'donnees.php';

$database = new Database();
$db = $database->getConnection();
$table = $_GET['table'];
$donnees = new Donnees($db, 0, 0, 0, 0, 0, 0);

if($donnees->maxID($table))
{
    http_response_code(201);
    echo json_encode($donnees->maxID($table));
}else
{
    http_response_code(404);
    echo json_encode(array("message" => "Erreur !"));
}