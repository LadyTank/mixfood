<?php
require_once 'inc/init.php';
$message = '';
$contenu = '';

if (estConnecte()) {
    header('location:profil_client.php');
    exit();
}
//Traitement du formulaire de connexion
// jeprint_r($_POST);
if (!empty($_POST)) {
    if (empty($_POST['email']) || empty($_POST['mot_de_passe'])) {
        $contenu .= '<div class="alert alert-danger">Veuillez fournir vos informations de connexion</div>';
    } /*fin du if !isset pseudo et mdp */

    if (empty($contenu)) {
        $resultat = executeRequete(" SELECT * FROM utilisateur WHERE email = :email", array(':email' => $_POST['email']));

        if ($resultat->rowCount() == 1) {

            // traitement du mot de passe 
            $utilisateur = $resultat->fetch(PDO::FETCH_ASSOC);
            // jeprint_r($utilisateur);

            if (password_verify($_POST['mot_de_passe'], $utilisateur['mot_de_passe'])) {
                $_SESSION['utilisateur'] = $utilisateur;
                header('location:profil_client.php');
                exit();
            } else {
                $contenu .= '<div class="alert alert-danger">Erreur sur les identifiants 1.</div>';
            } /*fin  if */
        } else {
            $contenu .= '<div class="alert alert-danger">Erreur sur les identifiants 2.</div>';
        } /*fin if ($resultat)*/
    } /*if (empty($contenu))*/
} /*if !empty($_POST)*/


// Déconnexion de l'internaute
session_destroy(); //On détruit le cookie de l'identifiant.
header("../index.php");
// jeprint_r($_GET);

include 'inc/haut.php';
?>

<main class="container m-4 mx-auto p-3 ">
    <div class="tailleC container row">
        <div>
            <?php
            echo $message;
            echo $contenu;
            ?>
        </div>
        <div class="col-sm-12 col-md-8 col-lg-8 m-auto p-4 text-center">
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
            <div class="small text-center mb-2"><a href="../contact.php" class="lienVert text-dark"> Mot de passe oublié</a></div>
            <p class="small text-center mt-3">Vous n'êtes pas inscrit ? <a href="inscription_client2.php" class="lienBlanc text-warning mx-auto">Inscrivez-vous ici</a></p>
            <a href="../index.php" class="lienVert">Retour sur le site</a>
        </div>
        <div class="col-lg-4 col-md-4 d-none d-sm-done d-md-block d-lg-block my-5 w-20">
            <img src="../img/sushiDessin5.png" alt="dessin sushi fun" class="img-fluid">
        </div>
    </div>
</main>

<?php
include 'inc/bas.php';
?>