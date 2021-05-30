<?php

require_once 'inc/init.php';
require_once 'inc/functions.php';
require_once 'inc/haut.php';

if (!empty($_POST)) {
    //On verify que le formulaire a bien été envoyer
    $nom_categorie =  htmlspecialchars($_POST['nom_categorie']);

    // On verify le button radio selectionner
    if (isset($_POST['en_vedette'])) {
        $en_vedette =  htmlspecialchars($_POST['en_vedette']);
    } else {
        $en_vedette = "non";
    }

    // on verifie si le nom_categorie va être en disponible ou bon
    if (isset($_POST['disponible'])) {
        $disponible =  htmlspecialchars($_POST['disponible']);
    } else {
        $disponible = "non";
    }

    // TRAITEMENT DES IMAGES
    // On verifie si les images sont cselectionner
    //print_r($_FILES['nom_image']['name']);
    //die();

    // var_dump( $nom_image);
    //die();



    if (isset($_FILES['nom_image']['name'])) {

        $nom_image = htmlspecialchars($_FILES['nom_image']['name']); //nom_image
        // upload image only if selected
        if ($nom_image != "") {


            // auto rename OUR image
            // get the extension of our image (jpg, png ,gif, etc) e.g "special.food.jpg"
            $tmp = explode('.', $nom_image);
            $file_extension = end($tmp);

            // renomme les images
            $nom_image = "Produit_categorie_" . rand(000, 999) . '.' . $file_extension; // e.g => Food_category_232.jpg

            $source_path = $_FILES['nom_image']['tmp_name']; // source path (source du fichier)
            //var_dump($source_path);
            $destination_path = "../img/categorie/" . $nom_image; // destination path (destination du fichier)

            // Now we can Upload the file( on televerse cette image de la source at le destination)
            $upload = move_uploaded_file($source_path, $destination_path);

            if ($upload == false) {
                // SET message
                $_SESSION['upload'] = "<div class=\"alert alert-danger\">Image Failed to  upload</div>";
                // redirect to add Category page
                header('location:' . SITEURL . 'Admin/ajouter_categorie.php');
                // STOP 
                die();
            }
        }
    } else {

        $nom_image = "";
    }

    // 2. On prepare la requête sql . Les données seront persister des que le bouton submit est activé
    $sql = $pdoSITE->prepare("INSERT INTO produit_categorie 
                            SET nom_categorie ='$nom_categorie',
                                nom_image ='$nom_image',
                                en_vedette='$en_vedette',
                                disponible='$disponible' ");


    // On execute la requête
    $requete = $sql->execute();
    //var_dump($requete);

    if ($requete  == TRUE) {
        // cQuery executed correctly and data added to the database
        $_SESSION['ajouter_cat'] =  " <div class=\"alert alert-success row col-col-4\">Catégorie ajouter avec succès</div>"; // create a new section called 'add'

        header('location:' . SITEURL . 'admin/gestion_categorie.php');
        exit();
    } else {
        //Failed to add category
        $_SESSION['ajouter_cat'] = "<div class=\"alert alert-success row col-col-4\">Erreur ! laCatégorie n'a pas été ajouter</div>";

        header('location:' . SITEURL . 'admin/ajouter_categorie.php');
        exit();
    }
}


?>

<div class="container m-auto">
    <div class="row">
        <div class="col-sm-12 col-md-6 m-auto my-5 p-5">

            <div class="card m-auto alert alert-success p-5">
                <h2 class="bg-light p-4 text-center mb-5">Nouvelle catégorie</h2>
                <!-- début de formulaire -->
                <form method="POST" action="" enctype="multipart/form-data" class="">

                    <div class="form-group mb-3">
                        <label for="nom_categorie"> Nom catégorie</label>
                        <input type="text " class="form-control text-right" name="nom_categorie" id="nom_categorie">
                    </div>

                    <div class="form-group mb-3">
                        <label for="nom_image">Choisir une image</label>
                        <input type="file" class="form-control text-right" name="nom_image" id="nom_image">
                        <!-- <input type="file" id="nom_image" name="nom_image"> -->
                    </div>


                    <div class="form-group mb-3">
                        <label for="en_vedette">En vedette </label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="en_vedette" id="en_vedette" value="oui">
                            <label class="form-check-label" for="f">oui</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="en_vedette" id="en_vedette" value="non">
                            <label class="form-check-label" for="m">non</label>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="disponible">Disponibilité </label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="disponible" id="disponible" value="oui">
                            <label class="form-check-label" for="disponible">oui</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="disponible" id="disponible" value="non">
                            <label class="form-check-label" for="disponible">non</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-small btn-success mt-2 pull-right">AJOUTER</button>

                </form> <!-- fin de formulaire -->
            </div><!-- Fin de card -->

        </div><!-- Fin de col -->
    </div><!-- Fin row -->
</div> <!-- fin de container-->


<?php require_once 'inc/bas.php' ?>