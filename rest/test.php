<?php
include_once 'database.php';
include_once 'donnees.php';
ini_set('display_errors', 1);
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Instancier la classe Database pour se connecter à la base de données
$database = new Database();
$conn = $database->getConnection();

// Instancier la classe Donnees en passant l'objet de connexion PDO en argument
$donnees = new Donnees($conn, 25, 21320244, elec, 30, 0, "2019-05-01T12:00:00");

// Utiliser la méthode readAll de la classe Donnees pour récupérer toutes les données de la table DonneesBrut
$stmt = $donnees->readAll();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "ID: " . $row['id'] . "<br>";
    echo "Identifiant: " . $row['identifiant'] . "<br>";
    echo "Données: " . $row['donnees'] . "<br>";
    echo "Données2: " . $row['donnees2'] . "<br>";
    echo "Grandeur: " . $row['grandeur'] . "<br>";
    echo "Date de réception: " . $row['date_recept'] . "<br><br>";
}

$conn = null;