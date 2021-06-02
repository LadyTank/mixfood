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
    <link rel="stylesheet" href="scss/normalize.css">

    <!-- Les styles -->
    <link rel="stylesheet" href="scss/style.css">

    <!-- Les typographies -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Give+You+Glory&family=Rock+Salt&display=swap" rel="stylesheet">

    <title>MIXFOOD</title>
</head><!-- / fin head -->
<!-- body -->

<body class="">

    <!-- navbar -->
    <div class="container-fluid bg-dark">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="navbar mixfood">
            <div class="container-fluid">
                <a class="navbar-brand typoChoix titreLogo d-none d-lg-block d-md-block" href="index.php">MIXFOOD</a>
                <a class="navbar-brand typoChoix titreLogo d-sm-block d-md-none d-lg-none" href="index.php"><img src="img/logoMobile.png" alt="logo Mixfood Mobile"></a>
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
            <div class="container-fluid col-sm-12 col-lg-2 mx-auto">

                <a href="admin/inscription_client2.php">
                    <button class=" btn btn-success mr-1 mb-1 mx-auto boutonNav" id="btn-inscription">S'inscrire</button>
                </a>
                <a href="admin/connexion_client.php" class="mx-auto">
                    <button class=" btn btn-success mx-auto mb-1 mx-auto boutonNav" id="btn-connexion" style="width:130%;">Se connecter</button>
                </a>

            </div>

        </nav>
    </div>

    <!-- diaporama accueil -->

    <div id="carouselAccueil" class="carousel slide carousel-fade bg-dark d-none d-sm-none d-lg-block d-md-block" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselAccueil" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselAccueil" data-bs-slide-to="1" aria-label="Slide 2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active ">
                <img src="img/pizzaH.jpg" class="d-block w-100 h-50 img-carrousel photoD" alt="pizza succulente">
            </div>
            <div class="carousel-item">
                <img src="img/sushi2H.jpg" class="d-block w-100 h-50 img-carrousel photoD" alt="sushi alléchant">
            </div>

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselAccueil" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselAccueil" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- container principal -->
    <div class="container m-auto">
        <h2 class="text-center col titreChoix">Votre choix</h2>

        <div class="row  text-center my-5">
            <div class="col-lg-6">
                <a href="#"> <img src="img/pizza-napolitaine.jpg" alt="Pizza" class="img-curvy img-thumbnail"></a>
            </div>
            <div class="col-lg-6">
                <a href="#"> <img src="img/pizza-napolitaine.jpg" alt="Pizza" class="img-curvy img-thumbnail"></a>
            </div>


        </div>

    </div><!-- /fin container principal -->
    <footer class="container-fluid text-muted py-3 bg-warning footer">
        <div class=" container-sm">
            <div class="row ">

                <div class="col-lg-3 d-none d-md-block d-lg-block ">
                    <div class="row">
                        <div class="col">
                            <h6><img src="../img/mixfoodNoir.png" alt="logo-mixfoo" class="img-fluid  mixfooter align-center pt-5" width="40%" height="40%"></h6>

                        </div>
                    </div>
                </div>

                <div class="col-lg-3 d-none d-md-block d-lg-block">
                </div>
                <div class=" col-6 col-lg-2">
                    <h6 class="text-upper text-dark">Moyens de paiement</h6>
                    <p>Paypal</p>
                    <p>Espèces</p>
                    <p>Carte bancaire</p>
                </div>
                <div class="col-6 col-lg-2">
                    <h6 class="text-upper text-dark">Contact</h6>
                    <p> Connexion</p>
                    <p> Menu</p>
                    <p> Service </p>
                </div>
                <div class="col">
                    <div class="row">
                        <p class="text-center text-md-left mt-5"><a href="#"><i class=" fab fa-facebook fa-5x"></i></a>
                        </p>
                    </div>

                </div>

            </div><!-- /row -->
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-10">
                    <p class="fw-light "> &copy;
                        <?php echo date("Y");  ?><a href="#"> mixfood </a> tous droits réservés
                    </p>
                </div>

            </div>

        </div>

    </footer>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
-->

</body>

</html>