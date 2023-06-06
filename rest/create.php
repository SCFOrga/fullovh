<?php
// required headers

ini_set('display_errors', 1);
error_reporting(E_ALL);
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
// database connection
include_once 'database.php';
// instantiation des objets
include_once 'donnees.php';
$database = new Database();
$db = $database->getConnection();
$data = json_decode(file_get_contents("php://input"));
$i = 0;
while($i < sizeof($data))
{
    print($data[$i]->grandeur);
    if(
        isset($data[$i]->identifiant) && isset($data[$i]->donnees)
        && isset($data[$i]->donnees2) && isset($data[$i]->grandeur)
        && isset($data[$i]->date_recept))
    {
        $identifiant = $data[$i]->identifiant;
        $donnees = $data[$i]->donnees;
        $donnees2 = $data[$i]->donnees2;
        $grandeur = $data[$i]->grandeur;
        $date_recept = $data[$i]->date_recept;
        $donnees = new Donnees($db, 0, $identifiant, $grandeur, $donnees, $donnees2, $date_recept);
        if($donnees->create())
        {
            http_response_code(201);
            echo json_encode(array("message" => "produit bien ajouté"));
        }
        else
        {
            http_response_code(503);
            echo json_encode(array("message" => "Unable to create product."));
        }
    }
    else{
        http_response_code(400);
        echo json_encode(array("message" => "Donnée incomplete."));
    }
    $i++;
}