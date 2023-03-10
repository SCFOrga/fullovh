<?php

$user = 'scf2023';
$pass = 'VDGE462zgrt23';


try {
    $db = new PDO ('mysql:host=localhost;dbname=scf2023', $user, $pass);
    foreach ($db->query('SELECT * FROM *')as $row){
        print_r($row);
    }
}
catch (PDOException $e){
    print "ERREUR :" . $e->getMessage() . "</br>";
    die;
}