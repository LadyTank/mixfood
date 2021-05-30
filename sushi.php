<?php
// author: baroude ntsiba
// contributor : Audrey
// contributor : Alexandre 
include 'inc/init.php';
include_once 'inc/haut.php';

$sql = $pdoSITE->prepare("SELECT p.produit_prix, p.id_produit, p.produit_image, p.nom_produit, p.produit_ingredients
FROM produit_categorie pc , produit p
WHERE pc.id_categorie=p.id_categorie  AND pc.nom_categorie='sushi' and p.produit_disponible='oui'");

//execute the sql statement as an object NOT an array

$sql->execute();

// fetch all rows into array, by default PDO::FETCH_BOTH is used
$result = $sql->fetchAll();
//var_dump($result);

// count the number of admin in the database
$nbr_food =  $sql->rowCount();

?>
<!-- ==================================================== -->
<!-- ==================== Card Pizza ==================== -->
<!-- ==================================================== -->
<h1 class="titreChoix text-white text-center mt-5">Nos sushis</h1>
<div class="container bg-dark py-2 pt-5 pb-4 my-3 img-curvy img-thumbnail img-responsive" style="background-color:#28a745; border-color:#28a745;">
    <!-- <div class="row text-center border border-danger">
        <div class="col-12 col-md-6 col-lg-4 mb-3 border border-primary"> -->

        <?php
    // si il y a des données
    if ($nbr_food > 0) {
        echo '<div class="row text-center">';

        // Pour chaque  ligne
        // on récupère la valeur de chaque clef 

        foreach ($result as $row) {
            // on assigne chaque valeurs à une variable
            $id_produit = $row['id_produit'];
            $nom_produit = $row['nom_produit'];
            $produit_image  = $row['produit_image'];
            $produit_prix = $row['produit_prix'];
            $produit_ingredients = $row['produit_ingredients'];
            // classe contenant les col bootstrap5
            echo ' <div class="col-12 col-md-6 col-lg-4 mb-3 ">';


            // si l'image du produit est vide ?
            if ($produit_image == '') {
                // on affiche ce message 
                echo 'image nexiste pas';
            } else { //sinon


                // on affiche l'image / photo correspendante
                // cette image est située dans img/produit
                // 
                echo '<img src="' . SITEURL . 'img/produit/' . $produit_image . '" class="img-curvy img-thumbnail img-responsive" style="background-color:#28a745; border-color:#28a745;">';
                // en bas nous avont le code html de l'accordion plus le bouton
                echo '<div class="accordion accordion-flush my-2 mx-auto" id="accordionP6" style="width:50%">';
                echo '<div class="accordion-item bg-success">';
                '<h2 class="accordion-header" id="flush-head-accordionP6">'; 
                echo ' <button class="accordion-button collapsed btn" type="button" data-bs-toggle="collapse" data-bs-target="#flush-accordionP6" aria-expanded="false" aria-controls="flush-accordionP6" style="background-color: #0a5846ab; color: #fff">' . $produit_prix . ' €' .
                    '</button>';
                echo ' </h2>';

                echo   ' <div id="flush-accordionP6" class="accordion-collapse collapse bg-success" aria-labelledby="flush-head-accordionP6" data-bs-parent="#accordionP6">';
                echo '<div class="accordion-body">';
                echo  ' <p>'  . $produit_ingredients . '</p>';// on affiche les incgrédientd
                echo            '</div>';
                echo    ' </div>';
                echo ' </div>';
                echo '</div>';
            }

            echo '</div>';
        }// fin foreach

        echo '</div>';
    }
    ?>

</div>
<?php
include_once 'inc/bas.php';
?>