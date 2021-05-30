<?php
include 'inc/init.php';
$sql =  $pdoSITE->prepare("SELECT * FROM produit_categorie  WHERE disponible='oui' AND en_vedette ='oui' ");
//execute the sql statement as an object NOT an array
// on execute la requte sql 
$sql->execute();
// fetch all, récuperer toutes les entrées de données par default PDO::FETCH_BOTH est utilisé
$result =   $sql->fetchAll();
// count le nombre de catégorie présent dans la bdd
$nbr_categorie =  $sql->rowCount();
//var_dump($nbr_categorie);

//////////  AFFICHAGE DES PLATS / SUSHI ET PIZZA  ////////////////
// Query to get all Categories from database
$sql2 =  $pdoSITE->prepare("SELECT * FROM produit WHERE produit_vedette='oui' AND produit_disponible ='oui'");
//execute the sql statement as an object NOT an array
$sql2->execute();
// fetch all rows into array, by default PDO::FETCH_BOTH is used
$result2 =   $sql2->fetchAll();
//var_dump($result);
// count the number of admin in the database
$nbr_food =      $sql2->rowCount();


include 'inc/haut.php';
include 'inc/diaporama.php';

?>

<!-- /container principal -->
<div class="container m-auto">
    <h2 class="text-center my-5 text-light titreChoix"> Pourquoi choisir ? ...</h2>
    <?php
    if ($nbr_categorie > 0) {
        // there are record in the database
        echo ' <div class="row">';
        foreach ($result as $row) {
            $id_categorie = $row['id_categorie'];
            $nom_categorie = $row['nom_categorie'];
            $nom_image  = $row['nom_image'];

            echo ' <div class="col-6 mt-3  text-center mb-5">';
            if ($nom_image == '') {
                // Display an error message 
                echo 'image NOT found';
            } else {
                // Display the image
                echo '<img src="' . SITEURL . 'img/categorie/' . $nom_image . '" class="img-curvy img-thumbnail img-responsive" width="50%" height="50%" style="background-color:#28a745; border-color:#28a745;"></div>';
            }
        }
        echo '</div>';
    }
    ?>

</div><!-- /fin container principal -->

<?php
include 'inc/bas.php';
?>