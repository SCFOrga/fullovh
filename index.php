<?php
include 'view/header/header.php';
session_start();
if(!isset($_SESSION['hash'])){
    header('Location: login/login.php');
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<section class="jumbotron bg-orange text-white">
    <div class="container">
        <h1 class="display-4">Suivi de Consommation des Fluides</h1>
    </div>
</section>
<section class="py-5">
    <div class="container">
        <h2 class="mb-5" class="test"><u class="title">Quelques données:</u></h2>
        <div class="row">
            <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <i class="fa fa-code fa-3x mb-3 text-orange"></i>
                <h3 class="card-title">Le temps actuel (en °C)</h3>
                <?php
                $bdd = new PDO("mysql:host=by93828-001.privatesql;dbname=scf2023;port=35146" , "scf2023", "VDGE462zgrt23");
                $req = $bdd->prepare('SELECT * FROM `DonneesTemp`  ORDER BY `date_recept` DESC LIMIT 1 ');
                $req ->execute();
                $temp = array();
                while($resultat = $req->fetch(PDO::FETCH_ASSOC)){
                    $temp[] = $resultat;
                }
                print_r($temp[0]['donnees']);
                ?>
            </div>
        </div>
    </div>
            <div class="card">
                <div class="card-body">
                    <i class ="fa fa-code fa-3x mb-3 text-orange"></i>
                    <h3 class="card-title">La consommation journalière en électricité (en KW/h)</h3>
                    <?php
                    $bdd = new PDO("mysql:host=by93828-001.privatesql;dbname=scf2023;port=35146" , "scf2023", "VDGE462zgrt23");
                    $req = $bdd->prepare('SELECT * FROM `ElecJour`  ORDER BY `dateJour` DESC LIMIT 1 ');
                    $req ->execute();
                    $temp = array();
                    while($resultat = $req->fetch(PDO::FETCH_ASSOC)){
                        $temp[] = $resultat;
                    }
                    print_r($temp[0]['conso']);
                    ?>
                </div>
            </div>
        </div>
</section>
<section class="py-4">
    <div class="container">
        <h2 class="mb-5" class="test"><u class="title">Nos Graphiques:</u></h2>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <i class="fa fa-code fa-3x mb-3 text-orange"></i>
                        <h3 class="card-title">Graphique consommation d'eau</h3>
                        <p class="card-text"><h6>Cliquez ici pour voir le graphique de consommation d'eau</h6></p>
                        <a href="Graph/GraphEau/graphJ.php" class="btn btn-blue">Voir le graphique</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <i class="fa fa-laptop fa-3x mb-3 text-orange"></i>
                        <h5 class="card-title">Graphique consommation Chauffage</h5 >
                        <p class="card-text"><h6>Cliquez ici pour voir le graphique de consommation de chauffage</h6></p>
                        <a href="Graph/GraphCT/graphJ.php" class="btn btn-orange">Voir le graphique</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <i class="fa fa-code fa-3x mb-3 text-orange"></i>
                        <h3 class="card-title">Graphique consommation d'Electricité</h3>
                        <p class="card-text"><h6>Cliquez ici pour voir le graphique de consommation d'Electricité</h6></p>
                        <a href="Graph/GraphElec/graphJ.php" class="btn btn-yellow">Voir le graphique</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body2">
                        <i class="fa fa-code fa-3x mb-3 text-orange"></i>
                        <h3 class="card-title">Graphique des températures</h3>
                        <p class="card-text"><h6>Cliquez ici pour voir les températures extérieurs</h6></p>
                        <a href="Graph/GraphT/graphJ.php" class="btn btn-grey">Voir le graphique</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</section>


</body>
</html>
<?php
include 'view/footer/footer.php';