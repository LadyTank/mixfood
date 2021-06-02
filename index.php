<?php
include 'inc/initOn.php';
$sql =  $pdoSITE->prepare("SELECT * FROM produit_categorie  WHERE disponible='oui' AND en_vedette ='oui' ");

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
<div class="container mx-auto">
    <h2 class="text-center mt-5 text-light titreChoix d-none d-md-block d-lg-block"> Pourquoi choisir ?</h2>
    <h2 class="text-center mt-5 text-light titreChoix  d-sm-block d-md-none d-lg-none"> Sélectionner</h2>

    <?php


    // section destop
    if ($nbr_categorie > 0) {
        // il y a des données dans la bdd
        echo ' <div class="row">';
        foreach ($result as $row) {
            $id_categorie = $row['id_categorie'];
            $nom_categorie = $row['nom_categorie'];
            $nom_image  = $row['nom_image'];

            echo ' <div class="col-6 mt-3  text-center mb-5 d-none d-md-block d-lg-block">';
            if ($nom_image == '') {
                // affiche une message d'erreur
                echo 'image introuvable';
            } else {
                // on affiche la photo si le nom de l'image existe dans la bdd
                echo '<a href="' . SITEURL . $nom_categorie . '.php ">';
                echo '<img src="' . SITEURL . 'img/categorie/' . $nom_image . '" class="img-curvy img-thumbnail img-responsive" width="40%" height="40%" style="background-color:#28a745; border-color:#28a745;"></div>';
                echo '</a>';
            }
        }
        echo '</div>';
    }
    // section mobile
    if ($nbr_categorie > 0) {
        // il y a des données dans la bdd
        echo ' <div class="row">';
        foreach ($result as $row) {
            $id_categorie = $row['id_categorie'];
            $nom_categorie = $row['nom_categorie'];
            $nom_image  = $row['nom_image'];

            echo ' <div class="col-sm-12 col-md-6 col-lg-6 mt-3  text-center mb-5 d-xs-block d-sm-block d-lg-none d-md-none">';
            if ($nom_image == '') {
                // affiche une message d'erreur
                echo 'image introuvable';
            } else {
                // on affiche la photo si le nom de l'image existe dans la bdd
                echo '<a href="' . SITEURL . '/' . $nom_categorie . '.php ">';
                echo '<img src="' . SITEURL . 'img/categorie/' . $nom_image . '" class="img-curvy img-thumbnail img-responsive" width="50%" height="50%" style="background-color:#28a745; border-color:#28a745;"></div>';
                echo '</a>';
            }
        }
        echo '</div>';
    }
    ?>


</div><!-- /fin container-->

<div class="container mx-auto circleC d-none d-lg-block d-md-block">

    <div class=""><img src="img/chefC.jpg" alt="" class="alignRight img-curvy img-thumbnail circle m-4 bg-success border-success"></div>

    <h1 class="titreChoix p-4 text-left espace">À propos de nous ...</h1>
    <p class="typoChoix text-justify p-4 m-4 espace">Bonjour je m'apelle Massimo zanoti, originaire de Naples en Italie.<br>
        Tous nos produits sont frais et souvent régionaux.<br>
        3 années au Japon pour apprendre l'art délicat des sushis et makis.<br>
        Aujourd'hui, j'ai choisi Suresnes pour partager ma passion culinaire avec vous, et rapidement.
    </p>

</div>

<?php
include 'inc/bas.php';
?>