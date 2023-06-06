<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");

include_once 'database.php';
include_once 'donnees.php';

$database = new Database();
$db = $database->getConnection();
$id = $_GET['id'];
$grandeur = $_GET['grandeur'];
$donnees = new Donnees($db, $id, 0, $grandeur, 0, 0, 0);
if($donnees->delete())
{
    http_response_code(201);
    echo json_encode(array("message" => "Produit bien supprimé !"));
}else
{
    http_response_code(404);
    echo json_encode(array("message" => "Produit non trouvé !"));
}
