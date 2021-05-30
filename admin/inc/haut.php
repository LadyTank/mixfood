<!doctype html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!-- Les icônes-->
    <script src="https://kit.fontawesome.com/b41dcf0f5f.js" crossorigin="anonymous"></script>

    <!-- normalize -->
    <link rel="stylesheet" href="../scss/normalize.css">

    <!-- Les styles -->
    <link rel="stylesheet" href="../scss/style.css">

    <!-- Les typographies -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Give+You+Glory&family=Rock+Salt&display=swap" rel="stylesheet">

    <title>MIXFOOD</title>
</head><!-- / fin head -->
<!-- body -->

<body class="">

    <header class="container-fluid bg-dark">
        <!-- navbar -->
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="navbar mixfood">
                <div class="container-fluid">
                    <a class="navbar-brand typoChoix titreLogo d-none d-lg-block d-md-block" href="../index.php">MIXFOOD</a>
                    <a class="navbar-brand typoChoix titreLogo d-sm-block d-md-none d-lg-none" href="../index.php"><img src="../img/logoMobile.png" alt="logo Mixfood Mobile"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarM" aria-controls="navbarM" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="navbar-collapse collapse justify-content-center" id="navbarM">
                        <ul class="navbar-nav align-items-center ">
                            <li class="nav-item">
                                <a class="nav-link espace" aria-current="page" href="index.php">Accueil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link espace" href="sushi.php">SUSHI</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link espace" href="pizza.php">PIZZA</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link espace" href="contact.php">Contact</a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="container col-sm-11 col-md-6 col-lg-3 mx-auto justify-content-between navbar-collapse collapse ">
                    <?php

                    if (estConnecte()) { // si membre utilisateur connecté
                        if (estAdmin()) { // si le membre connecté est administrateur
                            echo '<button class="btn btn-success nav-item m-2"><a class="nav-link lienBlanc espace" href="profil_client.php">ADMIN</a></button>';
                        } else {
                            echo '<button class="btn btn-success nav-item m-2"><a class="nav-link lienBlanc espace" href="profil_client.php">ADMIN</a></button>';
                        }
                        echo '<button class="btn btn-danger nav-item"><a class="nav-link lienBlanc espace" href="profil_client.php?action=deconnexion">Déconnexion</a></button>';
                    } else { //sinon
                        echo '<button class=" btn btn-light nav-item m-2"><a class="nav-link text-dark espace" href="inscription_client2.php">Inscription</a></button>';
                        echo '<button class=" btn btn-success nav-item"><a class="nav-link lienBlanc espace" href="connexion_client2.php">Connexion</a></button>';
                    }
                    ?>
                </div>
            </nav>
    </header>