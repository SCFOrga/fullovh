<?php
session_start();
if(!isset($_SESSION['hash'])){
    header('Location: ../../login/login.php');
}
$bdd = new PDO("mysql:host=by93828-001.privatesql;dbname=scf2023;port=35146" , "scf2023", "VDGE462zgrt23");
$req =$bdd->prepare('SELECT * FROM `ElecMois`  ORDER BY `dateMois` DESC LIMIT 10 ');
$req ->execute();
$temp = array();
while($resultat = $req->fetch(PDO::FETCH_ASSOC)){
    $temp[] = $resultat;
}
//print_r($temp);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Graphique de consommation d'électricité</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../../index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="graphJ.php">Conso / Jour</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="graphS.php">Conso / Semaine</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="graphA.php">Conso / An</a>
                    </li>
                    <li class="nav-item-1">
                        <a class="nav-link active" href="../../login/deletesess.php">Se déconnecter</a>
                    </li>
                </ul>
                </form>
            </div>
        </div>
    </nav>
</header>
<body>
<div class="txt"><h3>Graphique de la consommation d'<u>Electricité</u> par mois</h3></div>
<div style="width: 800px;">
    <canvas id="myChart"></canvas>
</div>
<?php
// les données pour le graphique
$data = array();
for($i = count($temp)-1; $i >= 0; $i--)
{
    $data[substr($temp[$i]['dateMois'], 0, 10)] = intval($temp[$i]['conso']);
}
//print_r($temp);
// conversion du tableau de données en JSON pour l'utilisation dans Chart.js
$data_json = json_encode(array(
    "labels" => array_keys($data),
    "datasets" => array(
        array(
            "label" => "Consomation en KW/h",
            "data" => array_values($data),
            "backgroundColor" => "rgba(54, 162, 235, 0.5)",
            "borderColor" => "rgba(54, 162, 235, 1)",
            "borderWidth" => 1
        )
    )
));

// affichage du script Chart.js pour afficher le graphique
echo "<script>
	var data = $data_json;
	var ctx = document.getElementById('myChart').getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'bar',
		data: data,
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true
					}
				}]
			}
		}
	});
	</script>";
?>
</body>
</html>