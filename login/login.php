<!DOCTYPE html>
<html lang="fr">
<?php
    session_start();
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Projet SCF</title>
    <meta name="description" content="Connexion">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic&amp;display=swap">
    <link rel="stylesheet" href="style.css">
</head>

<body style="position: sticky;border-radius: -1px;border-right-width: 23px;background: var(--bs-border-color);">
    <div class="container" style="display: block;position: static;text-align: center;background: var(--bs-body-bg);margin-top: 10%;width: 696px;height: 569px;border: 1px solid black;border-radius: 53px;">
        <section class="py-4 py-xl-5">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-md-8 col-xl-6 text-center mx-auto">
                        <h2>Connexion</h2>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-md-6 col-xl-4" style="border-color: var(--bs-red);width: 412.328px;">
                        <div class="card mb-5">
                            <div class="card-body d-flex flex-column align-items-center" style="height: 197px;border-style: none;border-color: var(--bs-purple);border-top-style: none;border-top-color: var(--bs-card-bg);">
                                <form class="text-center" method="post" action="logpost.php">
                                    <div class="mb-3"><input class="form-control" type="text" name="username" placeholder="Nom D'utilisateur" style="width: 324px;"></div>
                                    <div class="mb-3"><input class="form-control" type="password" name="password" placeholder="Mot De Passe" style="width: 324px;"></div>
                                    <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit" style="width: 324px;">Connexion</button></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/clean-blog.js"></script>
</body>

</html>