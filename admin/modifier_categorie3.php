<?php
require_once 'inc/init.php';
//Vérification de la session : 
// jeprint_r($_SESSION);

// Connexion obligatoire pour accéder à la page 
if (!estConnecte()) {
    header('location:connexion_client2.php'); // renvoie à la page de connexion
}

// Gestion de l'affichage des informations categorie
if (estConnecte()) {
    $resultat = $pdoSITE->prepare("SELECT * FROM produit_categorie WHERE id_categorie = :id_categorie");
    $resultat->execute(array(
        ':id_categorie' => $_GET['id_categorie']
    ));
    // print_r($resultat);
    if ($resultat->rowCount() == 0) {
        header('location:gestion_categorie.php');
        exit();
    } // fin du if
    $fiche = $resultat->fetch(PDO::FETCH_ASSOC);
    // jeprintr($fiche);
} else {
    header('location:gestion_categorie.php'); // 
    exit();
}


// Gestion de la modification 
if (!empty($_POST)) { // Si des données sont en POST
    // jevardump($_POST);
    // GESTION DES DONNEES POST ENVOYEES
    // limiter le champs de saisie
    if (!isset($_POST['nom_categorie']) || strlen($_POST['nom_categorie']) > 50) {
        $contenu .= '<div class="alert alert-danger">Doit comporter maximum 50 caractères.</div>'; // 
    }

    // gérer les modifications
    if (empty($contenu)) {
        // proteger les champs de saisies
        $_POST['nom_categorie'] = htmlspecialchars($_POST['nom_categorie']);
        $_POST['en_vedette'] = htmlspecialchars($_POST['en_vedette']);
        $_POST['disponible'] = htmlspecialchars($_POST['disponible']);

        // preparer la requete
        $succes = $pdoSITE->prepare("UPDATE produit_categorie SET id_categorie = :id_categorie, nom_categorie = :nom_categorie,  nom_image = :nom_image, en_vedette = :en_vedette, disponible = :disponible,  WHERE id_categorie = :id_categorie");
        // executer la requete avec l'indication des marqueurs
        $succes->execute(array(

            ':id_categorie' => $_GET['id_categorie'],
            ':nom_categorie' => $_POST['nom_categorie'],
            ':nom_image' => $_POST['nom_image'],
            ':en_vedette' => $_POST['en_vedette'],
            ':disponible' => $_POST['disponible'],

        ));

        if ($succes) {
            $contenu .= '<div class="alert alert-warning col-4 text-center mx-auto mb-4">La catégorie est modifiée</div>';
        } else {
            $contenu .= '<div class="alert alert-warning col-4 text-center mx-auto mb-4">Erreur lors de la modification !</div>';
        }
    } // fin du if empty
}

include 'inc/haut.php';
?>

<!-- include header -->
<?php include_once 'inc/haut.php'; ?>
<div class="container m-auto">

    <!-- form -->
    <div class="row">
        <div class="col-sm-12 col-md-6 mx-auto p-4 m-5">

            <div class="card  alert alert-success border border-success">
                <h2 class="bg-succes p-4 text-center ">Modifier la catégorie</h2>
                <!-- début de formulaire -->
                <form method="POST" action="" class=" row p-5 m-2 border border-success alert alert-success " id="formulaireModificationC" enctype="multipart/form-data">



                    <div class="form-group mb-3 text-center m-auto">
                        <!-- affichage ancienne image -->
                        <?php
                        $sql2 =  $pdoSITE->prepare("SELECT * FROM produit_categorie WHERE id_categorie = :id_categorie");

                        //execute the sql statement as an object NOT an array
                        $sql2->execute(array(
                            ':id_categorie' => $_GET['id_categorie'],
                        ));

                        // fetch all rows into array, by default PDO::FETCH_BOTH is used
                        $resultat2 =   $sql2->fetchAll();
                        //var_dump($result);
                        ?>
                        <img src="<?php echo SITEURL; ?>img/<?php echo $resultat2['']; ?>" class="img-fluid">


                    </div>



                    <div class="list-group list-group-horizontal-lg list-group-horizontal-md my-3">
                        <label for="nom_categorie" class="form-label "> Nom catégorie</label>
                        <input type="text " class="form-control mx-5 list-group-item " name="nom_categorie" value=" <?php echo $fiche['nom_categorie'] ?> " id="nom_categorie">
                    </div>

                    <div class="form-group my-3">
                        <label for="nom_image" class="form-label">Choisissez une nouvelle image</label>
                        <input type="file" class="form-control" name="nom_image" id="nom_image">
                        <!-- <input type="file" id="nom_image" name="nom_image"> -->
                    </div>

                    <div class="form-group ">
                        <label for="en_vedette">En vedette </label>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input m-3" type="radio" name="en_vedette" id="en_vedette" value="oui" checked> oui
                            <input class="form-check-input m-3" type="radio" name="en_vedette" id="en_vedette" value="non" <?php if (isset($fiche['en_vedette']) && $fiche['en_vedette'] == 'non') echo 'checked'; ?>> non
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="disponible">Disponible </label>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input m-3" type="radio" name="disponible" id="disponible" value="oui" checked> oui
                            <input class="form-check-input m-3" type="radio" name="disponible" id="disponible" value="non" <?php if (isset($fiche['disponible']) && $fiche['disponible'] == 'non') echo 'checked'; ?>> non
                        </div>
                    </div>



                    <div class="text-center">
                        <button type="submit" class="btn btn-small btn-success espace m-4">MODIFIER</button>
                    </div>

                </form> <!-- fin de formulaire -->
            </div><!-- Fin de card -->

        </div><!-- Fin de col -->
    </div><!-- Fin row -->

</div><!-- / menu-princpal -->


<!-- include the footer -->
<?php include_once 'inc/bas.php'; ?>