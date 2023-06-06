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
    if(
        isset($data[$i]->id) && isset($data[$i]->identifiant) && isset($data[$i]->donnees) &&
        isset($data[$i]->donnees2) && isset($data[$i]->grandeur)
        && isset($data[$i]->date_recept))
    {

        $id = $data[$i]->id;
        $identifiant = $data[$i]->identifiant;
        $donnees = $data[$i]->donnees;
        $donnees2 = $data[$i]->donnees2;
        $grandeur = $data[$i]->grandeur;
        $date_recept = $data[$i]->date_recept;
        $donnees = new Donnees($db, $id, $identifiant, $grandeur, $donnees, $donnees2, $date_recept);


        if(!$donnees->readOne())
        {
            http_response_code(404);
            print($donnees->date_recept);
            echo json_encode(array("message" => "Produit non trouvé!"));
            exit;
        }

        if($donnees->update())
        {
            http_response_code(201);
            echo json_encode(array("message" => "produit bien mis-à-jour",
                                   "id" => $donnees->id));
        }
        else
        {
            http_response_code(503);
            echo json_encode(array("message" => "Unable to update product."));
        }
    }
    else{
        http_response_code(400);
        echo json_encode(array("message" => "Donnée incomplete."));
    }
    $i++;
}