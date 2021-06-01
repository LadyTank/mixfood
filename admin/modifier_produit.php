
<?php     

require_once 'inc/init.php';
require_once 'inc/functions.php';


//////////////////
///
//ON obtient des data ancien
// on verify si il ya bien an id selectionner
if (isset ($_GET['id_produit'])) {
    // on prépare une requete. Selectionne les données correspendant à cet categorie ID
    $requete = $pdoSITE->prepare("SELECT * FROM produit WHERE id_produit = :id_produit");

    // On execute la requete
    $requete->execute(array (
        ':id_produit' => $_GET['id_produit'],
    ));
  

    // count le nombre le données correspendant à cette id
    $nbr_produit =      $requete->rowCount();

    // si le nom de id est supériur à 0
    
    if ($nbr_produit > 0) {

        // On récupère toute les données
        // fetch all rows into array, by default PDO::FETCH_BOTH is used
        $result     =   $requete->fetch(PDO::FETCH_ASSOC);
        //var_dump($result );
        $nom_categorie      =   $result['nom_produit'];
        $image_actuelle =   $result['produit_image'];
        $produit_disponible  =   $result['produit_disponible'];
        $produit_vedette    =   $result['produit_vedette'];
        $produit_prix = $result['produit_prix'];
        $produit_ingredients = $result['produit_ingredients'];

        //var_dump($result);
    } else {
        // si l'id n'est pas retrouvé on enclanche la session erreur
        $_SESSION['pr_non_trouver'] = "<div class=\"alert alert-warning row col-4\">Produit non trouvé</div>";
        // On redirect vers la gestdion de categorie
        // c'est une sécurité de plus 
        header('location:' . SITEURL . 'admin/gestion_produit.php');
    }
} else {
    //en redirect vers modifier categorie
    // si on essaye de changer l'id manuellement
    // c'est aussi une sécurité
    echo " accèss non autorisé";
   header('location:' . SITEURL . 'admin/modifier_produit.php');
}



//////////////////
///
//TRAITEMENT DES NOUVELLES DONNES

if (!empty($_POST)) {
//     // 1. Get the value from thw categorie FORM
        $_POST['nom_produit'] = htmlspecialchars($_POST[ 'nom_produit']);
        $_POST['produit_image'] = htmlspecialchars($_POST[ 'produit_image']);
        $image_actuelle = htmlspecialchars(isset($_POST[ 'produit_image' ]));
        $_POST['produit_vedette'] = htmlspecialchars($_POST[ 'produit_vedette']);
        $_POST['produit_disponible'] = htmlspecialchars($_POST[ 'produit_disponible']);
        $_POST['produit_ingredients'] = htmlspecialchars($_POST[ 'produit_ingredients']);
        $_POST['id_categorie'] = htmlspecialchars($_POST[ 'categorie']);
        $_POST['produit_prix'] = htmlspecialchars($_POST[ 'produit_prix']);

//     // On met à jour la nouvelle image
        if (isset($_FILES['produit_image']['name'])) {
        // get image details
        $produit_image = $_FILES['produit_image']['name'];

        // verify whether the image is avalaible or not
         if ($produit_image != '') {

            if ($produit_image != '') { // start of i image is not empty

               // auto rename OUR image
                // get the extension of our image (jpg, png ,gif, etc) e.g "special.food.jpg"
                $tmp = explode('.', $produit_image);
                $file_extension = end($tmp);
        

                // rename the image 
                $produit_image = "Produit_" . rand(000, 999) . '.' . $file_extension; // e.g => Food_category_232.jpg

                 $source_path = $_FILES['produit_image']['tmp_name']; // source path
                 //var_dump($source_path);
               $destination_path = "../img/produit/" . $produit_image; // destination path

                 // Now we can Upload the file
                 $upload = move_uploaded_file($source_path, $destination_path);

                // Check whether the image is uploaded or not
                 // And if the image failed to ulpload, stop then redirect to error message
                 if ($upload == false) {
                     // SET message
                     $_SESSION['telecharger'] = "<div class=\"alert alert-danger\">Image n'as pu être téléversée</div>";
                     // redirect to add Category page
                     header('location:' . SITEURL . 'admin/ajout_produit.php');

                     die(); // STOP 
                 }

                 //var_dump($destination_path);
             }
             // B. REMOVE Current Image if available(NOT empty)
            if ($image_actuelle != '') {
                 $remove_path = "../img/produit/". $image_actuelle;
                 $remove = unlink($remove_path);
                 var_dump($remove);
                 // check whether the image is remove or not
                 // if failed to remove then display error message die()

                  if ($remove == false) {
                      $_SESSION['erreur-telechargement'] = "<div class=\"alert alert-danger\"> Failed to update new the image </div>";
                   header('location:' . SITEURL . 'Admin/gestion_categorie.php');

                      die(); // STOP 
                 }
             }
        } else { // if an image is NOT selected; $produit_image => $image_actuelle;
             $produit_image = $image_actuelle;
         }
     } else {
         // $produit_image => $image_actuelle;
         $produit_image = $image_actuelle;
     }
   
     //jevardump( $remove_path);

     // 2. Prepare the query to be inserted once the user insert data in the form
       
    $resultat = $pdoSITE->prepare(" UPDATE produit SET id_categorie = :id_categorie, nom_produit = :nom_produit, produit_image = :produit_image,produit_ingredients = :produit_ingredients,produit_prix = :produit_prix, produit_vedette = :produit_vedette, produit_disponible = :produit_disponible WHERE id_produit = :id_produit ");
    $resultat->execute( array(
    ':id_categorie' => $_POST['id_categorie'],
    ':nom_produit' => $_POST[ 'nom_produit' ],
    ':produit_image' => $photo_bdd,
    ':produit_ingredients' => $_POST[ 'produit_ingredients' ],
    ':produit_prix' => $_POST[ 'produit_prix' ],
    ':produit_vedette' => $_POST[ 'produit_vedette' ],
    ':produit_disponible' => $_POST[ 'produit_disponible' ],
    ':id_produit' => $_GET[ 'id_produit' ] 
) );



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
<?php include_once 'inc/haut.php' ;?>
<div class="container m-auto">
      
        <?php
        // if( isset   ($_SESSION['actualiser'])  )   // verify whether the $session is SET or NOT
        // {
        //         echo $_SESSION['actualiser']=  " <div class=\"alert alert-wrning row col-col-6\">Admin Data Updated Successfully</div>";// Display the $session message
        //         session_unset(  ); // remove the $session message
        // }

        ?>
        <!-- form -->
        <div class="row"><!-- début row -->
        <div class="col-sm-12 col-md-6 mx-auto p-4">

            <div class="card m-auto alert alert-light border border-warning">
                <h2 class="bg-warning p-4 text-center mb-5">Entréz votre produit</h2>
                <div class="form-group ">
                <p class="text-dark text-center ">
                <?php
                if ( isset($_POST[ 'produit_image' ])!== '') {
                    // Display it
                    echo '<img src="' . SITEURL . 'img/produit/' . $image_actuelle . '" class="img-fluid" >';
                } else {
                    // Display an error message
                    echo "<div class=\"alert alert-warning row col-col-6\">Aucune image trouvée</div>";
                }

                ?>
                </p>

            </div>
                
                <!-- début de formulaire -->
                <form method="POST" action="" enctype="multipart/form-data" class="">

                    <div class="form-group mb-3">
                        <label for="nom_produit"> Nom du produit</label>
                        <input type="text " class="form-control text-right" value=" <?php echo  $nom_categorie ;  ?>" name="nom_produit" id="nom_produit">
                    </div>

                    <div class="form-group mb-3">
                        <label for="produit_prix">Prix</label>
                        <input type="text " class="form-control text-right" value="<?php echo $produit_prix; ?>" name="produit_prix" id="produit_prix">
                    </div>


                    <div class="form-group mb-3">
                        <label for="produit_image">Choisir une nouvelle image </label>
                        <input type="file" class="form-control text-right" name="produit_image" id="produit_image">
                    </div>

                    <div class="form-group mb-3">
                        <label for="produit_ingredients" class="form-label">Ingrédients</label>
                        <textarea class="form-control text-right"  name="produit_ingredients" id="produit_ingredients" rows="3" ><?php echo $produit_ingredients; ?></textarea>
                    </div>


                    <div class="form-group mb-3">
                        <label for="produit_vedette">produit vedette </label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="produit_vedette" id="produit_vedette" value="oui" <?php
                            if($produit_vedette  == 'oui'){
                                echo 'checked';
                            }
                            
                            ?>>
                            <label class="form-check-label" for="f">oui</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="produit_vedette" id="produit_vedette" value="non" <?php
                            if($produit_vedette  == 'non'){
                                echo 'checked';
                            }
                            
                            ?>>
                            <label class="form-check-label" for="m">non</label>
                        </div>
                    </div>



                    <div class="form-group mb-3">
                        <label for="produit_disponible ">Disponibilité du produit</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="produit_disponible " id="produit_disponible " value="oui" <?php
                            if($produit_disponible == 'oui'){
                                echo 'checked';
                            }
                            
                            ?> >
                            <label class="form-check-label" for="produit_disponible ">oui</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="produit_disponible " id="produit_disponible " value="non"   <?php
                            if($produit_disponible  == 'non'){
                                echo 'checked';
                            }
                            
                            ?>>
                            <label class="form-check-label" for="produit_disponible ">non</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-small btn-warning">AJOUTER</button>

                </form> <!-- fin de formulaire -->
            </div><!-- Fin de card -->

        </div><!-- Fin de col -->
    </div><!-- Fin row -->

</div><!-- / menu-princpal -->


<!-- include the footer -->
<?php include_once 'inc/bas.php'; ?>