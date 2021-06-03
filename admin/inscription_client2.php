<?php

include 'inc/init.php';

// $contenu est dans la page init.php

if (!empty($_POST)) { // Si des données sont en POST
    // jeprint_r($_POST);
    // GESTION DES DONNEES POST ENVOYEES
    if (!isset($_POST['mot_de_passe']) || strlen($_POST['mot_de_passe']) < 4 || strlen($_POST['mot_de_passe']) > 20) {
        $contenu .= '<div class="alert alert-danger">Le mot de passe doit contenir entre 4 et 20 caractères.</div>';
    } // fin du if isset mdp

    if (!isset($_POST['nom']) || strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 20) {
        $contenu .= '<div class="alert alert-danger">Le nom doit contenir entre 2 et 20 caractères.</div>';
    } // fin du if isset nom

    if (!isset($_POST['prenom']) || strlen($_POST['prenom']) < 2 || strlen($_POST['prenom']) > 20) {
        $contenu .= '<div class="alert alert-danger">Le prénom doit contenir entre 2 et 20 caractères.</div>';
    } // fin du if isset prenom

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

    if (empty($contenu)) { // si la variable est vide c'est qu'il n'y a pas d'erreur sur le form
        $membre = executeRequete(
            " SELECT * FROM utilisateur WHERE email = :email",
            array(':email' => $_POST['email'])
        );

        if ($membre->rowCount() > 0) {
            $contenu .= '<div class="alert alert-danger">Cet email n\'est pas disponible</div>';
        } else { // si on inscrit le membre en BDD
            $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT); // hachage du mdp

            $succes = executeRequete(
                " INSERT INTO utilisateur (nom,prenom, email, telephone, mot_de_passe,adresse, ville, code_postal,date_enregistrement,statut_utilisateur) VALUES (:nom, :prenom, :email, :telephone, :mot_de_passe, :adresse, :ville, :code_postal, now(), 'client')",
                array(
                    ':nom'              => $_POST['nom'],
                    ':prenom'           => $_POST['prenom'],
                    ':email'            => $_POST['email'],
                    ':telephone'        => $_POST['telephone'],
                    ':mot_de_passe'     => $mot_de_passe, //on prend le mot de passe hashé
                    ':adresse'          => $_POST['adresse'],
                    ':ville'            => $_POST['ville'],
                    ':code_postal'      => $_POST['code_postal'],

                )
            );

            if ($succes) {
                $contenu .= '<div class="alert alert-success">Vous êtes inscrit <a href="connexion_client2.php">Cliquez ici pour vous connecter</a></div>';
                header('location:connexion_client2.php');
            } else {
                $contenu .= '<div class="alert alert-danger">Erreur lors de l`\enregistrement !</div>';
            } //fin du if $success
        } // fin du if ... else
    } // fin empty $contenu
} // fin du if !empty $_POST

include 'inc/haut.php';
?>

<!-- ********************************-->
<!-- CONTENU PRINCIPAL -->
<!-- ********************************-->
<main class="container mx-auto ">
    <div class="row">
        <div class="col-sm-12 mx-auto ">
            <h1 class="text-center titreChoix text-white">Inscrivez-vous !!!</h1>
        </div><!-- Fin de col -->
    </div><!-- Fin row -->

    <div class="row mb-5">

        <div class="col-lg-4">
            <img src="../img/sushiDessin6.png" alt="dessin sushi dans la sauce" class="img-fluid">
        </div>
        <div class="col-sm-12 col-md-8 col-lg-8 m-auto pb-4 ">
            <?php
            echo $contenu;
            ?>
            <!-- DEBUT DU FORMULAIRE -->
            <form method="POST" action="" class=" row p-5 m-2 border border-dark alert alert-dark " id="formulaireInscription">


                <div class="form-group p-2 col-sm-12 col-md-4 col-lg-4">
                    <!-- nom -->
                    <label for="nom" class="form-label">Nom de famille*</label>
                    <input type="text" class="form-control text-right" name="nom" id="nom" value="<?php echo $_POST['nom'] ?? ''; ?>" required placeholder="Votre nom de famille">
                </div>
                <div class="form-group p-2 col-sm-12 col-md-4 col-lg-4">
                    <!-- prenom -->
                    <label for="prenom" class="form-label">Prénom*</label>
                    <input type="text " class="form-control text-right" name="prenom" id="prenom" value="<?php echo $_POST['prenom'] ?? ''; ?>" required placeholder="Votre prénom">
                </div>
                <div class="form-group p-2 col-sm-12 col-md-4 col-lg-4">
                    <!-- mot_de_passe -->
                    <label for="mot_de_passe" class="form-label">Mot de passe*</label>
                    <input type="password" class="form-control text-right" name="mot_de_passe" id="mot_de_passe" required placeholder="Seul vous le connaissez">
                    <small class='text-muted'> 4 à 20 caractères</small>
                </div>
                <div class="form-group p-2 col-sm-12 col-md-7 col-lg-7">
                    <!-- mail -->
                    <label for="email" class="form-label">Adresse éléctronique*</label>
                    <input type="email" class="form-control text-right" name="email" id="email" value="<?php echo $_POST['email'] ?? ''; ?>" required placeholder="Votre email">
                </div>
                <div class=" form-group p-2 col-sm-12 col-md-5 col-lg-5">
                    <!-- telephone -->
                    <label for="telephone" class="form-label">Téléphone*</label>
                    <input type="text" name="telephone" class="form-control" id="telephone" required placeholder="Votre numéro de téléphone">
                </div>
                <div class="form-group p-2">
                    <!-- adresse -->
                    <label for="adresse" class="form-label">Adresse postale*</label>
                    <textarea name="adresse" id="adresse" class="form-control" required placeholder="Votre adresse en cas de livraison"><?php echo $_POST['adresse'] ?? ''; ?></textarea>
                </div>
                <div class="form-group p-2 col-sm-12 col-md-6 col-lg-6">
                    <!-- code_postal -->
                    <label for="code_postal" class="form-label">Code Postal*</label>
                    <input type="text" class="form-control text-right" name="code_postal" id="code_postal" value="<?php echo $_POST['code_postal'] ?? ''; ?>" required placeholder="Votre code-postal">
                </div>
                <div class="form-group p-2 col-sm-12 col-md-6 col-lg-6">
                    <!-- ville -->
                    <label for="ville" class="form-label">Ville*</label>
                    <input type="text" class="form-control" name="ville" id="ville" value="<?php echo $_POST['ville'] ?? ''; ?>" required placeholder="Votre ville">
                </div>

                <div class="form-group text-center">
                    <!-- bouton reseat formulaire -->
                    <button class="btn btn-dark mt-3" type="reset" value="Reset">Effacer</button>

                    <!-- bouton envoyer -->
                    <button type="submit" class="btn btn-success mt-3">S'inscrire</button>

                </div>
            </form> <!-- fin de formulaire -->
        </div><!-- Fin de col -->


    </div><!-- Fin de row -->


</main><!-- Fin container -->

<?php
include 'inc/bas.php';
?>