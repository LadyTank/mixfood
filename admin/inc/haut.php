<!doctype html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

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

    <!-- navbar -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-expand-md static-top">
        <div class="container">
            <picture>
                <!-- affichage logo mode mobile -->
                <source media="(max-width: 1024px)" srcset="../img/logoMobile.png 1x" class="logoMobile">
                <!-- affichage logo mode destok -->
                <source media="(min-width: 1024px)" srcset="../img/logoBlanc.png 2x" class="logoDestok">
                <img src="img/logoBlanc.png" alt="logo-mixfood" class="mt-3 img-responsive mb-3">
            </picture>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse justify-content-end" id="navbar">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item active">
                        <a class="nav-link m-4 espace" href="../index.php">MIXFOOD</a>
                    </li>
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle m-4 espace" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Menu</a>
                        <ul class="dropdown-menu bg-light" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item espace liVert" href="../pizza.php">Pizza</a></li>
                            <li><a class="dropdown-item espace liVert" href="../sushi.php">Sushi</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link m-4 espace" href="../about.php">Qui sommes-nous ?</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link m-4 espace" href="../contact.php">Contact</a>
                    </li>
                </ul>

            </div>
        </div>
        <div class="container col-sm-11 col-lg-2 mx-auto justify-content-center navbar-collapse collapse ">
            <?php

            // visible pour les administrateurs
            // if (estAdmin()) {
            //     echo '<ul class="navbar-nav align-items-center  d-none d-lg-block d-md-block">';
            //     echo '<li class="nav-item"><a class="nav-link lienBlanc espace" href="manage_utilisateur_client.php">ADMIN</a></li>';
            //     echo '<li class=" nav-item"><a class="nav-link lienBlanc espace" href="gestion_produit.php">Produit</a></li>';
            //     echo '<li class=" nav-item"><a class="nav-link lienBlanc espace" href="#">Commande</a></li></ul>';
            // }

            if (estConnecte()) { // si membre utilisateur connecté
                if (estAdmin()) {
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