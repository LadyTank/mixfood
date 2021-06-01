<?php

require_once 'inc/init.php';
require_once 'inc/functions.php';


//////////////////
///
//ON obtient des data ancien
// on verifie si il ya bien un id sélectionné
if (isset($_GET['id_categorie'])) {
    // on prépare une requête. Selectionne les données correspendant à cette categorie ID
    $requete = $pdoSITE->prepare("SELECT * FROM produit_categorie WHERE id_categorie = :id_categorie");

    // On execute la requete
    $requete->execute(array(
        ':id_categorie' => $_GET['id_categorie'],
    ));


    // count le nombre de données correspendant à cette id
    $nbr_categorie =      $requete->rowCount();

    // si le nom de id est supériur à 0

    if ($nbr_categorie == 1) {

        // On récupère toute les données
        // fetch all rows into array, by default PDO::FETCH_BOTH is used
        $result     =   $requete->fetch(PDO::FETCH_ASSOC);
        $nom_categorie      =   $result['nom_categorie'];
        $image_actuelle =   $result['nom_image'];
        $en_vedette  =   $result['en_vedette'];
        $disponible     =   $result['disponible'];

        //var_dump($result);
    } else {
        // si l'id n'est pas retrouvé on enclanche la session erreur
        $_SESSION['cat_non_trouver'] = "<div class=\"alert alert-warning row col-4\">Catégorie non trouvée</div>";
        // On redirect vers la gestdion de categorie
        // c'est une sécurité de plus 
        header('location:' . SITEURL . 'admin/gestion_categorie.php');
    }
} else {
    //en redirect vers modifier categorie
    // si on essaye de changer l'id manuellement
    // c'est aussi une sécurité
    echo " accès non autorisé";
    header('location:' . SITEURL . 'admin/modifier_categorie.php');
}



//////////////////
///
//TRAITEMENT DES NOUVELLES DONNES

if (!empty($_POST)) {
    // 1. Get the value from thw categorie FORM
    $_POST['nom_categorie'] = htmlspecialchars($_POST['nom_categorie']);
    $_POST['nom_image'] = isset($_POST['$image_actuelle']);
    $_POST['en_vedette'] = $_POST['en_vedette'];
    $_POST['disponible'] = $_POST['disponible'];


    // On met à jour la nouvelle image
    if ($_FILES['nom_image']['name']) {
        // get image details
        $nom_image = $_FILES['nom_image']['name'];

        // verify whether the image is avalaible or not
        if ($nom_image != '') {

            if ($nom_image != '') { // start of i image is not empty

                // auto rename OUR image
                // get the extension of our image (jpg, png ,gif, etc) e.g "special.food.jpg"
                $tmp = explode('.', $nom_image);
                $file_extension = end($tmp);


                // rename the image 
                $nom_image = "Produit_categorie_" . rand(000, 999) . '.' . $file_extension; // e.g => Food_category_232.jpg

                $source_path = $_FILES['nom_image']['tmp_name']; // source path
                //var_dump($source_path);
                $destination_path = "../img/categorie/" . $nom_image; // destination path

                // Now we can Upload the file
                $upload = move_uploaded_file($source_path, $destination_path);

                // Check whether the image is uploaded or not
                // And if the image failed to ulpload, stop then redirect to error message
                if ($upload == false) {
                    // SET message
                    $_SESSION['telecharger'] = "<div class=\"alert alert-danger\">Image n'as pu être téléversée</div>";
                    // redirect to add Category page
                    header('location:' . SITEURL . 'Admin/add_category.php');

                    die(); // STOP 
                }

                //var_dump($destination_path);
            }
            // B. REMOVE Current Image if available(NOT empty)
            if ($image_actuelle != '') {
                $remove_path = "../img/categorie/" . $image_actuelle;
                $remove = unlink($remove_path);


                // var_dump($remove);
                // check whether the image is remove or not
                // if failed to remove then display error message die()

                // if ($remove == false) {
                //     $_SESSION['erreur-telechargement'] = "<div class=\"alert alert-danger\"> Failed to update new the image </div>";
                //     header('location:' . SITEURL . 'Admin/gestion_categorie.php');

                //     die(); // STOP 
                // }
            }
        } else { // if an image is NOT selected; $nom_image => $image_actuelle;
            $nom_image = $image_actuelle;
        }
    } else {
        // $nom_image => $image_actuelle;
        $nom_image = $image_actuelle;
    }

    // jevardump( $remove_path);

    // 2. Prepare the query to be inserted once the user insert data in the form
    $requete = $pdoSITE->prepare(
        "UPDATE produit_categorie 
            SET nom_categorie = :nom_categorie, 
            nom_image = :nom_image,
            en_vedette = :en_vedette, 
            disponible = :disponible
            WHERE id_categorie=:id_categorie"
    );

    // 3. Execute the query prepared above then, execute it 
    $requete->execute(
        array(
            // array awaiting to be executed by the prepared sql statement
            ':nom_categorie' => $_POST['nom_categorie'],
            ':nom_image' => $_POST['nom_image'],
            ':en_vedette' => $_POST['en_vedette'],
            ':disponible' => $_POST['disponible'],
            'id_categorie' => $_GET['id_categorie']

        )
    );



    //Redirect vers la page gestion categorie
    // si la requete est sql est réussite
    // if ($requete == TRUE) {
    //     // on active la session si la bdd est mise à jour avec toutes les nouvelles données 
    //     $_SESSION['actualiser'] = "<div class=\"alert alert-success row col-col-2\">Information bien actualiser</div>";
    //     header('location:' . SITEURL . 'admin/gestion_categorie.php');

    //     // $$requete->fetch(PDO::FETCH_ASSOC);
    // } else {
    //     // failed to update 
    //     $_SESSION['actualiser'] = "<div class=\"alert alert-warning row col-col-2\">L'actualisation à échouer</div>";
    //     header('location:' . SITEURL . 'admin/modifier_categorie.php');
    // }
}



?>

<!-- include header -->
<?php include_once 'inc/haut.php'; ?>
<div class="container m-auto">

    <?php
    // if( isset   ($_SESSION['actualiser'])  )   // verify whether the $session is SET or NOT
    // {
    //         echo $_SESSION['actualiser']=  " <div class=\"alert alert-wrning row col-col-6\">Admin Data Updated Successfully</div>";// Display the $session message
    //         session_unset(  ); // remove the $session message
    // }

    ?>
    <!-- form -->
    <div class="row">
        <div class="col-sm-12 col-md-6 mx-auto p-4 m-5">

            <div class="card  alert alert-success border border-success">
                <h2 class="bg-succes p-4 text-center ">Modifier la catégorie</h2>
                <!-- début de formulaire -->
                <form method="POST" action="" enctype="multipart/form-data" class="form-group p-4 m-auto ">

                    <div class="form-group mb-3 text-center m-auto">
                        <!-- ancienne image -->
                        <?php
                        if ($image_actuelle !== '') {
                            // Display it
                            echo '<img src="' . SITEURL . 'img/categorie/' . $image_actuelle . '" width="300" class="img-curvy img-fluid">';
                        } else {
                            // Display an error message
                            echo "<div class=\"alert alert-warning row col-col-4\">Aucune image n'est assignée à cette catégorie </div>";
                        }

                        ?>
                    </div>

                    <div class="list-group list-group-horizontal-lg list-group-horizontal-md my-2">
                        <label for="nom_categorie" class="form-label  mt-3 "> Nom catégorie</label>
                        <input type="text " class="form-control mx-5 list-group-item " name="nom_categorie" value="<?php echo $nom_categorie; ?> " id="nom_categorie">
                    </div>


                    <div class="form-group my-3">
                        <label for="nom_image" class="form-label">Choisissez une nouvelle image</label>
                        <input type="file" class="form-control" name="nom_image" id="nom_image">
                        <!-- <input type="file" id="nom_image" name="nom_image"> -->
                    </div>


                    <div class="form-group mt-3">
                        <label for="en_vedette" class="form-label">En vedette </label>
                        <div class="form-check form-check-inline  m-2">
                            <input <?php if ($en_vedette == "oui") {
                                        echo "checked";
                                    } ?> class="form-check-input" type="radio" name="en_vedette" id="en_vedette" value="oui">
                            <label class="form-check-label" for="f">oui</label>
                        </div>
                        <div class="form-check form-check-inline  m-2">
                            <input <?php if ($en_vedette == "non") {
                                        echo "checked";
                                    } ?>class="form-check-input" type="radio" name="en_vedette" id="en_vedette" value="non">
                            <label class="form-check-label form-label" for="m">non</label>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="disponible">Disponible </label>
                        <div class="form-check form-check-inline m-1">
                            <input <?php if ($disponible == "oui") {
                                        echo "checked";
                                    } ?> class="form-check-input" type="radio" name="disponible" id="disponible" value="oui">
                            <label class="form-check-label" for="disponible" class="form-label">oui</label>
                        </div>
                        <div class="form-check form-check-inline m-1">
                            <input <?php if ($disponible == "non") {
                                        echo "checked";
                                    } ?> class="form-check-input" type="radio" name="disponible" id="disponible" value="non">
                            <label class="form-check-label" for="disponible" class="form-label">non</label>
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