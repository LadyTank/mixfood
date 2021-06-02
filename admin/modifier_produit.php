<?php

require_once 'inc/init.php';
require_once 'inc/functions.php';


//////////////////
/// author : baroude ntsiba
//ON obtient des data ancien
// on verify si il ya bien an id selectionner
if (isset ($_GET['id_produit'])) {
    $id_produit = $_GET['id_produit'];
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
        $id_produit = $result['id_produit'];
        $id_cat_actuel = $result['id_categorie'];
        $nom_produit      =   $result['nom_produit'];
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

if(isset($_POST['submit'])){
    // on récupère les données du post
    $_POST['id_produit'] = htmlspecialchars($_POST['id_produit']);
    $_POST['nom_produit'] = htmlspecialchars($_POST['nom_produit']);
    //$_POST['produit_image'] = htmlspecialchars($_POST['produit_image']);
    $image_actuelle = $_POST['image_actuelle' ];
    $_POST['produit_vedette'] = htmlspecialchars($_POST['produit_vedette']);
    $_POST['produit_disponible'] = htmlspecialchars($_POST['produit_disponible']);
    $_POST['produit_ingredients'] = htmlspecialchars($_POST['produit_ingredients']);
    $_POST['produit_prix'] = htmlspecialchars($_POST['produit_prix']);
    $_POST['id_categorie'] = htmlspecialchars($_POST['categorie']);

    // On met à jour la nouvelle image
    if (isset($_FILES['produit_image']['name'])) {
        $produit_image = htmlspecialchars($_FILES['produit_image']['name']); //produit_image
        if ($produit_image != "") {
            // auto rename OUR image
            // get the extension of our image (jpg, png ,gif, etc) e.g "special.food.jpg"
            $tmp = explode('.', $produit_image);
            $file_extension = end($tmp);
            // renomme les images
            $produit_image = "Produit_mixfood" . rand(000, 999) . '.' . $file_extension; // e.g => Food_category_232.jpg
            $source_path = $_FILES['produit_image']['tmp_name']; // source path (source du fichier)
            //var_dump($source_path);
            $destination_path = "../img/produit/" . $produit_image; // destination path (destination du fichier)
            // Now we can Upload the file( on televerse cette image de la source at le destination)
            $upload = move_uploaded_file($source_path, $destination_path);
            if ($upload == false) {
                // SET message
                $_SESSION['upload'] = "<div class=\"alert alert-danger\">Image Failed to upload</div>";
                // redirect to add Category page
                header('location:' . SITEURL . 'admin/ajouter_produit.php');
                // STOP 
                die(); 
                }

                // Part ||  REMOVE Current Image if available(NOT empty)
                if($image_actuelle!= "")
                {
                   

                    $remove_path = "../img/produit/".$image_actuelle;
                    $remove = unlink($remove_path);

                    if($remove==false){
                        $_SESSION['erreur-telechargement'] = "<div class=\"alert alert-danger\"> Failed to update new the image </div>";
                        header('location:' . SITEURL . 'admin/gestion_produit.php');
                    
                        die(); // STOP 

                    }
                
            }

        }else
        {
           $produit_image = $image_actuelle;
       }
    
}



// on modifie le produit ici
$resultat = $pdoSITE->prepare(" UPDATE produit SET id_categorie = :id_categorie, nom_produit = :nom_produit, produit_image = :produit_image, produit_ingredients = :produit_ingredients,produit_prix = :produit_prix, produit_vedette = :produit_vedette, produit_disponible = :produit_disponible WHERE id_produit = :id_produit ");
$resultat->execute( array(
':id_categorie' => $_POST['categorie'],
':nom_produit' => $_POST[ 'nom_produit' ],
':produit_image' => $produit_image,
':produit_ingredients' => $_POST[ 'produit_ingredients' ],
':produit_prix' => $_POST[ 'produit_prix' ],
':produit_vedette' => $_POST[ 'produit_vedette' ],
':produit_disponible' => $_POST[ 'produit_disponible' ],
':id_produit' => $_GET[ 'id_produit' ] 
) );

if($resultat==TRUE)
{
      // on active la session si la bdd est mise à jour avec toutes les nouvelles données 
    $_SESSION['prod_actualiser'] = "<div class=\"alert alert-success row col-col-2\">Information bien actualiser !</div>";
    header('location:' . SITEURL . 'admin/gestion_produit.php');
}

else
{
    $_SESSION['erreur _actualisation'] = "<div class=\"alert alert-success row col-col-2\">Information n\' pas être actualisée !</div>";
    header('location:' . SITEURL . 'admin/modifier_produit.php');
}

if( $_FILES['produit_image']['name'] == false)
{
    $produit_image = $image_actuelle;
}


}// fin $_POST



?>

<!-- include header -->
<?php include_once 'inc/haut.php'; ?>
<div class="container m-auto">

    <!-- form -->
    <div class="row">
        <!-- début row -->
        <div class="col-sm-12 col-md-6 mx-auto p-4">

            <div class="card m-auto alert alert-light border border-warning">
                <h2 class="bg-warning p-4 text-center mb-5">Entréz votre produit</h2>
                <div class="form-group ">
                <p class="text-dark text-center ">
                <?php
                // on affiche le l'image actuelle 
                // si seuelement si le nom de la photo n'existe pas
                if ( isset($_GET[ 'produit_image' ])!== '') {
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
                        <input type="text " class="form-control text-right" value="<?php echo $nom_produit ;?>" name="nom_produit" id="nom_produit">
                    </div>

                    <div class="form-group mb-3">
                        <label for="produit_prix">Prix</label>
                        <input type="text " class="form-control text-right" value="<?php echo $produit_prix;?>" name="produit_prix" id="produit_prix">
                    </div>


                    <div class="form-group mb-3">
                        <label for="produit_image">Choisir une nouvelle image </label>
                        <input type="file" class="form-control text-right" name="produit_image" id="produit_image">
                    </div>

                    <div class="form-group mb-3">
                        <label for="produit_ingredients" class="form-label">Ingrédients</label>
                        <textarea class="form-control text-right"  name="produit_ingredients" id="produit_ingredients" rows="3" ><?php echo $produit_ingredients;?></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="produit_categorie" class="bg-warning text-dark"><i class="fas fa-exclamation-triangle"></i>Quelle est sa catégorie ?</label>
                        <select class="form-select form-select-sm" name="categorie" id="categorie" aria-label="choix categorie">
                            <option value="">....</option>';
                            <?php
                            // on recupere toutes les catégorie
                            $sql =  $pdoSITE->prepare("SELECT * FROM produit_categorie WHERE disponible = 'oui' ");
                            // on execute la requete
                            $sql->execute();
                            // on assigne toutes les données dans a $requete, by default PDO::FETCH_BOTH is used
                            $result =   $sql->fetchAll();
                            //print_r($result);
                            // compte le nombre de catégorie
                            $count_nbr_cat =  $sql->rowCount();
                            if ($count_nbr_cat > 0) {
                                // pour chaque categories dans la bdd, on affiche ID et le nom comme option
                                foreach ($result as $row) {
                                    $id_categorie = $row['id_categorie'];
                                    $nom_categorie = $row['nom_categorie'];
                            ?> ;
                                    <option <?php if($id_cat_actuel==$id_categorie){ echo "selected" ;}  ?> value="<?php echo $id_categorie;?>"><?php echo $nom_categorie; ?></option>';
                            <?php
                                }
                            } else {
                                echo ' <option value=\"0\">Categorie n\'existe pas</option>';
                            }
                            ?>
                        </select>
                    </div>


                    <div class="form-group mb-3">
                        <label for="produit_vedette">produit vedette </label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="produit_vedette" id="produit_vedette" value="oui" <?php
                            if($produit_vedette  == 'oui'){
                                echo "checked";
                            }
                            
                            ?>>
                            <label class="form-check-label" for="f">oui</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="produit_vedette" id="produit_vedette" value="non" <?php
                            if($produit_vedette  == "non"){
                                echo "checked";
                            }
                            
                            ?>>
                            <label class="form-check-label" for="m">non</label>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="produit_disponible">dispo </label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="produit_disponible" id="produit_disponible" value="oui" <?php
                            if($produit_disponible  == 'oui'){
                                echo "checked";
                            }
                            
                            ?>>
                            <label class="form-check-label" for="f">oui</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="produit_disponible" id="produit_disponible" value="non" <?php
                            if($produit_disponible  == "non"){
                                echo "checked";
                            }
                            
                            ?>>
                            <label class="form-check-label" for="m">non</label>
                        </div>
                    </div>                    
                    <input type="hidden" name="image_actuelle" value="<?php echo $image_actuelle;?>">
                    <input type="hidden" name="id_produit" value="<?php echo $id_produit; ?>"> 
                    <button type="submit" name="submit" class="btn btn-small btn-warning">Modifier</button>

                </form> <!-- fin de formulaire -->

            </div><!-- Fin de card -->

        </div><!-- Fin de col -->
    </div><!-- Fin row -->

</div><!-- / menu-princpal -->


<!-- include the footer -->
<?php include_once 'inc/bas.php'; ?>