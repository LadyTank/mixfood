<?php
require_once 'inc/init.php';
//Vérification de la session : 
// jeprint_r($_SESSION);

// Connexion obligatoire pour accéder à la page profil
if (!estConnecte()) {
    header('location:connexion_client2.php'); // renvoie à la page de connexion
}

// Gestion de l'affichage des informations clients
if (estConnecte()) {
    $resultat = $pdoSITE->prepare("SELECT * FROM utilisateur WHERE id_utilisateur = :id_utilisateur");
    $resultat->execute(array(
        ':id_utilisateur' => $_SESSION['utilisateur']['id_utilisateur']
    ));
    // print_r($resultat);
    if ($resultat->rowCount() == 0) {
        header('location:profil_client.php');
        exit();
    } // fin du if
    $fiche = $resultat->fetch(PDO::FETCH_ASSOC);
    // jeprintr($fiche);
} else {
    header('location:profil_client.php'); // 
    exit();
}

// Déconnexion de l'internaute
// jeprint_r($_GET);
if (isset($_GET['action']) && $_GET['action'] == 'deconnexion') {
    unset($_SESSION['utilisateur']);
    // $message = '<div class="alert alert-primary">Vous êtes déconnecté.</div>';
    header('location:connexion_client2.php');
}

// Gestion de la modification de profil
if (!empty($_POST)) { // Si des données sont en POST
    // jevardump($_POST);
    // GESTION DES DONNEES POST ENVOYEES

    if (!isset($_POST['email']) || strlen($_POST['email']) > 50 || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

        $contenu .= '<div class="alert alert-danger">Votre email n\'est pas conforme.</div>'; // 
    } // fin if !isset email

    if (!isset($_POST['telephone']) || !preg_match('#^[0-9]{10}$#', $_POST['telephone'])) {
        $message .= '<div class="alert alert-danger">le numéro saisi n\'est pas valide.</div>';
    } //  if (!isset($_POST['telephone']) 

    if (!isset($_POST['adresse']) || strlen($_POST['adresse']) < 6 || strlen($_POST['adresse']) > 50) {
        $contenu .= '<div class="alert alert-danger">L\'adresse est elle complète?</div>';
    } // fin du if isset adresse

    if (!isset($_POST['code_postal']) || !preg_match('#^[0-9]{5}$#', $_POST['code_postal']) > 5) {
        $contenu .= '<div class="alert alert-danger">Le code postal n\'est pas conforme.</div>';
    } // fin du if isset code_postal

    if (!isset($_POST['ville']) || strlen($_POST['ville']) < 1 || strlen($_POST['ville']) > 20) {
        $contenu .= '<div class="alert alert-danger">La ville doit contenir entre 1 et 20 caractères.</div>';
    } // fin du if isset ville

    // gérer les modifications de le profil
    if (empty($contenu)) {
        // proteger les champs de saisies
        $_POST['nom'] = htmlspecialchars($_POST['nom']);
        $_POST['prenom'] = htmlspecialchars($_POST['prenom']);
        $_POST['email'] = htmlspecialchars($_POST['email']);
        $_POST['code_postal'] = htmlspecialchars($_POST['code_postal']);
        $_POST['ville'] = htmlspecialchars($_POST['ville']);
        $_POST['adresse'] = htmlspecialchars($_POST['adresse']);
        $_POST['telephone'] = htmlspecialchars($_POST['telephone']);
        // preparer la requete
        $succes = $pdoSITE->prepare("UPDATE utilisateur SET id_utilisateur = :id_utilisateur, nom = :nom,  prenom = :prenom, email = :email, code_postal = :code_postal, ville = :ville, adresse = :adresse, telephone = :telephone  WHERE id_utilisateur = :id_utilisateur");
        // executer la requete avec l'indication des marqueurs
        $succes->execute(array(

            ':nom' => $_POST['nom'],
            ':prenom' => $_POST['prenom'],
            ':email' => $_POST['email'],
            ':code_postal' => $_POST['code_postal'],
            ':ville' => $_POST['ville'],
            ':adresse' => $_POST['adresse'],
            ':telephone' => $_POST['telephone'],
            ':id_utilisateur' => $_SESSION['utilisateur']['id_utilisateur'],

        ));

        if ($succes) {
            $contenu .= '<div class="alert alert-success">Votre profil est modifié</div>';
        } else {
            $contenu .= '<div class="alert alert-danger">Erreur lors de la modification !</div>';
        }
    } // fin du if empty
}

include 'inc/haut.php';
?>

<main class="container m-2 mx-auto p-2 row">
    <h1 class="mt-4 text-center titreChoix text-white">Bienvenue sur votre profil
        <?php
        if (estAdmin()) {
            echo ' administrateur';
        } else {
            echo 'client';
        }
        ?>
    </h1>

    <?php
    echo $message;
    ?>
    <?php
    // pourquoi le contenu ne s'affiche pas???
    echo $contenu;
    ?>

    <div class="col-12 row">
        <div class="col-sm-12 col-md-6 col-lg-6 mx-auto m-2 p-2">

            <h2 class="text-white text-center">Bonjour <?php echo $fiche['prenom']; ?> !</h2>

            <hr>


            <div class="card mx-auto alert alert-success">
                <div class="card-body ">
                    <h5 class="card-title text-center">Informations</h5>

                    <ul class="list-group list-group-horizontal-md list-group-horizontal-lg">
                        <li class="list-group-item col-sm-12 col-md-4 col-lg-4">Numéro de client :<br> <?php echo $_SESSION['utilisateur']['id_utilisateur']; ?> </li>
                        <li class="list-group-item col-sm-12 col-md-4 col-lg-4">Prénom :<br> <?php echo $fiche['prenom']; ?> </li>
                        <li class="list-group-item col-sm-12 col-md-4 col-lg-4">Nom : <br> <?php echo $fiche['nom']; ?> </li>
                    </ul>
                    <ul class="list-group list-group-horizontal-lg">
                        <li class="list-group-item col-sm-12 col-md-6 col-lg-6">Email :<br> <?php echo $fiche['email']; ?> </li>
                        <li class="list-group-item col-sm-12 col-md-6 col-lg-6">Adresse :<br> <?php echo $fiche['adresse']; ?> </li>
                    </ul>
                    <ul class="list-group list-group-horizontal-lg">
                        <li class="list-group-item col-sm-12 col-md-4 col-lg-4">Code postal :<br> <?php echo $fiche['code_postal']; ?> </li>
                        <li class="list-group-item col-sm-12 col-md-4 col-lg-4">Ville :<br> <?php echo $fiche['ville']; ?> </li>
                        <li class="list-group-item col-sm-12 col-md-4 col-lg-4">Téléphone :<br> <?php echo $fiche['telephone']; ?> </li>
                    </ul>
                </div>
                <div class="row my-3 p-3 justify-content-center ">
                    <div class="col-6 text-center">
                        <button type="button" class="btn btn-success btn-block" id="cacheImage">Modifier le profil</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 row text-center m-auto">
            <!-- bouton déroulant action pour l'administrateur -->
            <div class="dropdown col-3">
                <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Utilisateur
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="#">Ajouter</a></li>
                    <li><a class="dropdown-item" href="modifier_produit.php">Modifier</a></li>
                    <li><a class="dropdown-item" href="#">Supprimer</a></li>
                </ul>
            </div>
            <div class="dropdown col-3">
                <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                    Catégories
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                    <li><a class="dropdown-item" href="#">Ajouter</a></li>
                    <li><a class="dropdown-item" href="modifier_produit.php">Modifier</a></li>
                    <li><a class="dropdown-item" href="#">Supprimer</a></li>
                </ul>
            </div>
            <div class="dropdown col-3">
                <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                    Produit
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                    <li><a class="dropdown-item" href="#">Ajouter</a></li>
                    <li><a class="dropdown-item" href="modifier_produit.php">Modifier</a></li>
                    <li><a class="dropdown-item" href="#">Supprimer</a></li>
                </ul>
            </div>
            <div class="col-3">
                <a href="#" class="btn btn-success" tabindex="-1" role="button" aria-disabled="true">Commande</a>
            </div>
        </div>

    </div>

    <div class="col-12 mx-auto m-2 p-2 cache">
        <h2 class=" text-white text-center">Modifier votre profil</h2>

        <hr>
        <!-- DEBUT DU FORMULAIRE -->
        <form method="POST" action="" class=" row p-5 m-2 border border-success alert alert-success " id="formulaireModification">

            <div class="form-group p-2 col-sm-12 col-md-6 col-lg-6 d-none">
                <!-- id_utilisateur -->
                <label for="id_utilisateur" class="form-label">Numéro de client : </label>
                <input type="text" class="form-control text-right" name="id_utilisateur" id="id_utilisateur" value="<?php echo $fiche['id_utilisateur']; ?>" disabled>
            </div>
            <div class="form-group p-2 col-sm-12 col-md-6 col-lg-6">
                <!-- nom -->
                <label for="nom" class="form-label">Nom : </label>
                <input type="text" class="form-control text-right" name="nom" id="nom" value="<?php echo $fiche['nom']; ?>">
            </div>

            <div class="form-group p-2 col-sm-12 col-md-6 col-lg-6">
                <!-- prenom -->
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text " class="form-control text-right" name="prenom" id="prenom" value="<?php echo $fiche['prenom']; ?>">
            </div>
            <div class="form-group p-2 col-sm-12 col-md-6 col-lg-6">
                <!-- mail -->
                <label for="email" class="form-label">Adresse éléctronique</label>
                <input type="email" class="form-control text-right" name="email" id="email" value="<?php echo $fiche['email']; ?>" placeholder="Votre nouvel email">
            </div>
            <div class=" form-group p-2 col-sm-12 col-md-6 col-lg-6">
                <!-- telephone -->
                <label for="telephone" class="form-label">Téléphone</label>
                <input type="text" name="telephone" class="form-control" id="telephone" placeholder="Votre nouveau numéro " value="<?php echo $fiche['telephone']; ?>">
            </div>
            <div class="form-group p-2">
                <!-- adresse -->
                <label for="adresse" class="form-label">Adresse postale</label>
                <textarea name="adresse" id="adresse" class="form-control" placeholder="Votre nouvelle adresse"><?php echo $fiche['adresse']; ?></textarea>
            </div>
            <div class="form-group p-2 col-sm-12 col-md-6 col-lg-6">
                <!-- code_postal -->
                <label for="code_postal" class="form-label">Code Postal</label>
                <input type="text" class="form-control text-right" name="code_postal" id="code_postal" value="<?php echo $fiche['code_postal']; ?>" placeholder="Votre nouveau code-postal">
            </div>
            <div class="form-group p-2 col-sm-12 col-md-6 col-lg-6">
                <!-- ville -->
                <label for="ville" class="form-label">Ville</label>
                <input type="text" class="form-control" name="ville" id="ville" value="<?php echo $fiche['ville']; ?>" placeholder="Votre nouvelle ville">
            </div>

            <div class="form-group text-center">
                <!-- bouton reseat formulaire -->
                <button class="btn btn-dark mt-3" type="reset" value="Reset">Effacer</button>
                <!-- bouton envoyer -->
                <button type="submit" class="btn btn-success mt-3">Modifier</button>
            </div>
        </form> <!-- fin de formulaire -->
    </div> <!-- fin col-12 -->

    <!-- information stat de la bdd coté ADMIN-->
    <div class="row">
        <!-- row-->
        <div class="row g-4 mb-4 m-auto">
            <div class="col-6 col-lg-3">
                <div class="card h-100 rad">
                    <div class="card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">Total Sales</h4>
                        <div class="stats-figure">$12,628</div>
                        <div class="stats-meta text-success">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-up" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"></path>
                            </svg> 20%
                        </div>
                    </div>
                    <!--//card-body-->
                    <a class="card-link-mask" href="#"></a>
                </div>
                <!--//card-->
            </div>
            <!--//col-->

            <div class="col-6 col-lg-3">
                <div class="card rad h-100">
                    <div class="card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">Expenses</h4>
                        <div class="stats-figure">$2,250</div>
                        <div class="stats-meta text-success">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"></path>
                            </svg> 5%
                        </div>
                    </div>
                    <!--//card-body-->
                    <a class="card-link-mask" href="#"></a>
                </div>
                <!--//card-->
            </div>
            <!--//col-->
            <div class="col-6 col-lg-3">
                <div class="card rad h-100">
                    <div class="card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">Projects</h4>
                        <div class="stats-figure">23</div>
                        <div class="stats-meta">
                            Open</div>
                    </div>
                    <!--//card-body-->
                    <a class="card-link-mask" href="#"></a>
                </div>
                <!--//card-->
            </div>
            <!--//col-->
            <div class="col-6 col-lg-3">
                <div class="card rad h-100">
                    <div class="card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">Invoices</h4>
                        <div class="stats-figure">6</div>
                        <div class="stats-meta">New</div>
                    </div>
                    <!--//card-body-->
                    <a class="card-link-mask" href="#"></a>
                </div>
                <!--//card-->
            </div>
            <!--//col-->
        </div>


    </div><!-- /row-->

</main>

<!-- Mes scripts !!! -->

<script>
    let boutonForm = document.querySelector('#cacheImage');

    let formModif = document.querySelector('.cache');

    function cliqueBouton() {
        formModif.classList.toggle('cache');
    }

    boutonForm.addEventListener('click', cliqueBouton);
</script>


<?php
include 'inc/bas.php';
?>