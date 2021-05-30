	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/b41dcf0f5f.js" crossorigin="anonymous"></script>

	<?php

    require_once '../inc/init.php';
    require_once '../inc/functions.php';



    $message = '';

    $_POST['mot_de_passe'] = md5(htmlspecialchars($_POST['mot_de_passe']));
    var_dump($_POST['mot_de_passe']);

    if (!empty($_POST)) {




        var_dump($_POST['mot_de_passe']);



        if (!isset($_POST['nom']) || strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 20 ||  !preg_match("/[a-zA-Z\S]+$/", $_POST['nom'])) {
            $message = '<div class="alert alert-danger">Le nom doit contenir entre 3 et 20 caractères.</div>'; // si indice email inf à 4 caractère ou sup à 20 caractère on affiche ce message
        } // fin if !isset($_POST['nom']

        if (!isset($_POST['prenom']) || strlen($_POST['prenom']) < 2 || strlen($_POST['prenom']) > 20 ||  !preg_match("/[a-zA-Z\S]+$/", $_POST['prenom'])) {
            $message = '<div class="alert alert-danger">Le prenom doit contenir entre 3 et 20 caractères.</div>'; // si indice email inf à 4 caractère ou sup à 20 caractère on affiche ce message
        } // fin if !isset($_POST['prenom']

        if (!isset($_POST['email']) || strlen($_POST['email']) > 50 || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $message .= '<div class="alert alert-danger">Votre email n\'est pas conforme.</div>'; // filter_var -> filtre de variable // dans ce filtre on passe la fonction prédéfinie FILTER_VALIDATE_EMAIL (c'est une constante elle est écrite en MAJUSCULE) cette fonction vérifie que le format est bien de format email
        } // fin if !isset($_POST['email']

        if (!isset($_POST['telephone']) || !preg_match('#^[0-9]{10}$#', $_POST['telephone'])) {
            $message .= '<div class="alert alert-danger">le numéro saisi n\'est pas valide.</div>'; // est ce que le code postal correspond à l'expression régulière : la "regex" regular 
        } //  if (!isset($_POST['telephone'])


        if (!isset($_POST['mot_de_passe']) || strlen($_POST['mot_de_passe']) < 4 || strlen($_POST['mot_de_passe']) > 20) {
            $message = '<div class="alert alert-danger">Le mot depasse doit contenir entre 4 et 20 caractères.</div>'; // si indice email inf à 4 caractère ou sup à 20 caractère on affiche ce message
        } // fin if !isset($_POST['mot_de_passe']

        if (!isset($_POST['adresse']) || strlen($_POST['adresse']) < 6 || strlen($_POST['adresse']) > 60) {
            $message = '<div class="alert alert-danger">L\' adresse est -elle complète ?.</div>'; // si indice adresse inf à 4 caractère ou sup à 20 caractère on affiche ce message
        } // fin if !isset($_POST['adresse']

        if (!isset($_POST['ville']) || strlen($_POST['ville']) < 1 || strlen($_POST['ville']) > 30) {
            $message = '<div class="alert alert-danger">Vérifier le nom de votre ville ?.</div>'; // si indice adresse inf à 4 caractère ou sup à 20 caractère on affiche ce message
        } // fin if !isset($_POST['ville']


        if (!isset($_POST['code_postal']) || !preg_match('#^[0-9]{5}$#', $_POST['code_postal'])) {
            $message .= '<div class="alert alert-danger">le code postal n\'est pas valide.</div>'; // est ce que le code postal correspond à l'expression régulière : la "regex" regular 
        } //  if (!isset($_POST['code_postal'])



        $_POST['nom'] = htmlspecialchars($_POST['nom']);
        $_POST['prenom'] = htmlspecialchars($_POST['prenom']);
        $_POST['email'] = htmlspecialchars($_POST['email']);
        $_POST['telephone'] = htmlspecialchars($_POST['telephone']);
        $_POST['mot_de_passe'] = md5(htmlspecialchars($_POST['mot_de_passe']));
        $_POST['adresse'] = htmlspecialchars($_POST['adresse']);
        $_POST['ville'] = htmlspecialchars($_POST['ville']);
        $_POST['code_postal'] = htmlspecialchars($_POST['code_postal']);





        if (empty($message)) { // si la variable est vide, c'est que tu n'a pas d'erreur
            $utilisateur = executeRequete(
                " SELECT * FROM utilisateur WHERE email = :email",
                array(':email' => $_POST['email'])
            );


            if ($utilisateur->rowCount() > 0) { // si la requête retourne des lignes c'est que l'adresse mail existe déjà
                $message .= '<div class="alert alert-danger">Cet adresse email existe déja. <a href=\"#\">Connectez-vous entant client</a></div>';
            } else { // si on inscirt le utilisateur en BDD
                $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT); // cette fonction prédéfinie permet de cripter le mot de passe selon l'algorithme actuel "bcrypt".  Il faudra lors de la connexion comparer le hash de la BDD avec celui du mot_de_passe de l'intérieur
                // ici on insert les données dans la bdd 
                $succes = executeRequete(
                    " INSERT INTO utilisateur (nom,prenom, email, telephone, mot_de_passe,adresse, ville, code_postal,date_enregistrement,statut_utilisateur) VALUES (:nom, :prenom, :email, :telephone, :mot_de_passe, :adresse, :ville, :code_postal, now(), 'admin')",
                    array(
                        ':nom'              => $_POST['nom'],
                        ':prenom'           => $_POST['prenom'],
                        ':email'            => $_POST['email'],
                        ':telephone'        => $_POST['telephone'],
                        ':mot_de_passe'     => $_POST['mot_de_passe'], //on prend le mot de passe hashé
                        ':adresse'          => $_POST['adresse'],
                        ':ville'            => $_POST['ville'],
                        ':code_postal'      => $_POST['code_postal'],

                    )
                );

                if ($succes) {
                    $message .= '<div class="alert alert-success">Vous êtes inscrit <a href="#">Cliquez ici pour vous connecter</a></div>';
                } else {
                    $message .= '<div class="alert alert-danger">Erreur lors de l`\enregistrement !</div>';
                } //fin du if if if ($succes)
            } // fin de if else
        } // empty($message

    } // fin if !empty($_POST)

    //var_dump($mot_de_passe);


    // source possible https://grafikart.fr/tutoriels/gestion-utilisateur-229



    ?>

	<?php
    include 'inc/haut.php';
    echo "$message";





    ?>

	<h1>Ajouter un administrateur</h1>

	<form method="POST" action="" class="row g-3" id="formulaireInscription">

	    <div class="col-6 col-md-6 etoile">
	        <label for="prenom" class="form-label ">Prénom</label>
	        <input type="text" name="prenom" class="form-control " id="prenom" required="required">
	    </div>
	    <div class="col-6 col-md-6">
	        <label for="nom" class="form-label">Nom</label>
	        <input type="text" name="nom" class="form-control " id="nom" required>

	    </div>

	    <div class="col-12">
	        <label for="email" class="form-label">Email
	        </label>
	        <input type="email" name="email" class="form-control" id="email">
	    </div>
	    <div class="col-6 col-md-6">
	        <label for="telephone" class="form-label">Téléphone</label>
	        <input type="text" name="telephone" class="form-control" id="telephone">
	    </div>
	    <div class="col-6 col-md-6">
	        <label for="mot_de_passe" class="form-label">Password</label>
	        <input type="password" name="mot_de_passe" class="form-control" id="mot_de_passe">
	    </div>
	    <div class="col-12">
	        <label for="adresse" class="form-label">Adresse</label>
	        <input type="text" name="adresse" class="form-control" id="adresse" placeholder="Votre adresse">
	    </div>

	    <div class="col-6 col-md-6">
	        <label for="ville" class="form-label">Ville</label>
	        <input type="text" name="ville" class="form-control" id="ville">
	    </div>

	    <div class="col-6 col-md-2">
	        <label for="code_postal" class="form-label">Code postal</label>
	        <input type="text" name="code_postal" class="form-control" id="code_postal">
	    </div>
	    <div class="col-12">
	        <div class="form-check">
	            <input class="form-check-input" type="checkbox" id="gridCheck">
	            <label class="form-check-label" for="gridCheck">
	                Check me out
	            </label>
	        </div>
	    </div>
	    <div class="d-grid gap-2">
	        <!-- <button type="submit" class="btn btn-primary">Valider</button> -->

	        <button class="btn btn-primary" type="submit">Valider</button>

	    </div>

	</form>

	<?php

    require_once '../inc/navbar.php';

    ?>