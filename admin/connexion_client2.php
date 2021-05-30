<?php
require_once 'inc/init.php';
$message = '';
$contenu = '';

// jeprint_r($_POST);
// Vérification si membre est déjà connecté : 
if (estConnecte()) { // si membre déjà connecté on le renvoie vers son profil 
    header('location:profil_client.php'); //redirection vers la page profil.php script que l'on quitte tout de suite
    exit(); // pour quitter le script header() est une fonction prédéfinie
}
//Traitement du formulaire de connexion
// jeprint_r($_POST);
if (!empty($_POST)) { // si le formulaire est envoyé
    // validation du formulaire 
    if (empty($_POST['email']) || empty($_POST['mot_de_passe'])) { // si le chmap pseudo est vide ou la chmap mdp est vide.
        $contenu .= '<div class="alert alert-danger">Veuillez fournir vos informations de connexion</div>';
    } /*fin du if !isset pseudo et mdp */

    // sur le formulaire on vérifie le pseudo et le mdp en deux temps
    if (empty($contenu)) {
        // requête en BDD les informations du membre pour l'email fourni par l'internaute
        $resultat = executeRequete(" SELECT * FROM utilisateur WHERE email = :email", array(':email' => $_POST['email']));

        if ($resultat->rowCount() == 1) {

            // traitement du mot de passe 
            $utilisateur = $resultat->fetch(PDO::FETCH_ASSOC); // on fetch l'objet $resultat en un tableau associatif qui contient toutes les informations du membre. 

            jeprint_r($utilisateur);

            if (password_verify($_POST['mot_de_passe'], $utilisateur['mot_de_passe'])) { // si le hash du mdp de la bdd correspond au mdp du formulaire, alors password_verify retourne true
                $_SESSION['utilisateur'] = $utilisateur; // nous créons une session avec (une session est un fichier sur le serveur) avec les informations du membre provenant de la BDD )
                // redirection du membre vers l'accueil
                header('location:profil_client.php');
                exit();
            } else {
                $contenu .= '<div class="alert alert-danger">Erreur sur les identifiants 1.</div>';
            } /*fin  if (password_verify($_POST['mdp'], $membre['mdp']))*/
        } else {
            $contenu .= '<div class="alert alert-danger">Erreur sur les identifiants 2.</div>';
        } /*fin if ($resultat)*/
    } /*if (empty($contenu))*/
} /*if !empty($_POST)*/
// require_once 'inc/header.php';
echo $message; //pour afficher le message lors de la connexion
echo $contenu; //pour affciher les autres messages
// jeprint_r($_SESSION);
// jevardump($_SESSION);



// Déconnexion de l'internaute

session_destroy(); //On détruit le cookie de l'identifiant.
header("../index.php"); //On revient au départ.
// jeprint_r($_GET);

include 'inc/haut.php';
?>

<main class="container m-4 mx-auto p-4">
    <div class="col-sm-12 col-md-8 col-lg-7 mx-auto m-4 p-4 text-center">
        <form class="form-signin p-4 mx-auto text-center" method="POST" action="">
            <h1 class="h3 mb-3 font-weight-normal titreChoix text-white">Connectez-vous</h1>
            <div class="form-group mt-2 col-sm-12 col-md-6 col-lg-6 mx-auto">
                <label for="email" class="sr-only">Email</label>
                <input type="text" id="email" class="form-control" placeholder="votre email" autofocus name="email">
            </div>
            <div class="form-group mt-2  col-sm-12 col-md-6 col-lg-6 mx-auto">
                <label for="mot_de_passe" class="sr-only">Mot de passe</label>
                <input type="password" id="mot_de_passe" class="form-control" placeholder="vous seul le connaissez !" name="mot_de_passe">
            </div>
            <button class="btn btn-sm btn-success btn-block mt-2" type="submit">Connexion</button>

        </form>
        <p class="small text-center">Vous n'êtes pas inscrit ?</p>
        <p><a href="inscription_client2.php" class="lienBlanc text-warning mx-auto">Inscrivez-vous ici</a></p>
        <a href="../index.php" class="lienVert">Retour sur le site</a>
    </div>
</main>

<!-- Remove the container if you want to extend the Footer to full width. -->

<!-- Footer -->
<footer class="text-center text-lg-start text-white container-fluid bg-dark footerC">
    <!-- Grid container -->
    <div class="container-fluid pt-3">
        <!-- Section: Links -->
        <section class="">
            <!--Grid row-->
            <div class="row">
                <!-- Grid column -->
                <div class="col-md-3 col-lg-3 col-xl-3 d-none d-md-block d-lg-block ">
                    <h6><img src="../img/logoBlanc.png" alt="logo-mixfood" class="img-fluid  mixfooter align-center " width="35%" height="35%"></h6>
                </div>
                <!-- Grid column -->

                <hr class="w-100 clearfix d-md-none" />

                <!-- Grid column -->
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h6 class="text-uppercase mb-4 font-weight-bold vert">Moyen de paiement</h6>
                    <p>
                        <a class="text-white ">Espèces</a>
                    </p>
                    <p>
                        <a class="text-white">Carte bancaire</a>
                    </p>
                </div>
                <!-- Grid column -->

                <hr class="w-100 clearfix d-md-none" />

                <!-- Grid column -->
                <hr class="w-100 clearfix d-md-none" />

                <!-- Grid column -->
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h6 class="text-uppercase mb-4 font-weight-bold vert">CONTACT</h6>
                    <p>
                        <a class="text-white" href="connexion_client2.php">Connexion</a>
                    </p>
                    <p>
                        <a class="text-white" href="../index.php">Menu</a>
                    </p>
                </div>
                <!-- Grid column -->

                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                    <div class="bbb-wrapper fl-wrap">
                        <div class="subcribe-form fl-wrap">
                            <p class="vert">Newsletter </p>
                            <form id="subscribe" novalidate="true">
                                <input class="enteremail" name="EMAIL" id="subscribe-email" placeholder="Votre email" spellcheck="false" type="text">
                                <button type="submit" id="subscribe-button" class=" btn btn-success subscribe-button "><i class="fa fa-rss"></i> GO</button>
                                <label for="subscribe-email" class="subscribe-message"></label>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Grid column -->
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h6 class="text-uppercase text-center mb-4 font-weight-bold vert">Suivez-nous</h6>

                    <!-- Facebook -->
                    <p class="text-center text-md-left mt-5"><a href="#"><i class=" fab fa-facebook fa-5x icon-fb vert"></i></a></p>

                </div>
            </div>
            <!--Grid row-->
        </section>
        <!-- Section: Links -->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center">
        <p class="fw-light "> &copy;<?php echo date("Y");  ?><a href="#"> mixfood </a> tous droits réservés </p>
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->


<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
<script src="../../js/script.js"></script>

</body>

</html>