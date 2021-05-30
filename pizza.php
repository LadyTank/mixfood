<?php
// author: baroude ntsiba
// contributor : Audrey
// contributor : Alexandre 
include 'inc/init.php';
include_once 'inc/haut.php';

$sql =  $pdoSITE->prepare("SELECT p.produit_prix, p.id_produit, p.produit_image, p.nom_produit, p.produit_ingredients
FROM produit_categorie pc , produit p
WHERE pc.id_categorie=p.id_categorie  AND pc.nom_categorie='pizza' and p.produit_disponible='oui'");

//execute the sql statement as an object NOT an array

$sql->execute();

// fetch all rows into array, by default PDO::FETCH_BOTH is used
$result =   $sql->fetchAll();
//var_dump($result);

// count the number of admin in the database
$nbr_food =      $sql->rowCount();

?>
<!-- ==================================================== -->
<!-- ==================== Card Pizza ==================== -->
<!-- ==================================================== -->
<h1 class="titreChoix text-white text-center mt-5">Nos Pizzas</h1>
<div class="container bg-dark py-2 pt-5 pb-4 my-3 img-curvy img-thumbnail img-responsive" style="background-color:#28a745; border-color:#28a745;">
<<<<<<< Updated upstream
    <!-- <div class="row text-center border border-danger">
        <div class="col-12 col-md-6 col-lg-4 mb-3 border border-primary"> -->

    <?php
    if ($nbr_food > 0) {
        echo ' <div class="row text-center">';

        // there are record in the database

        foreach ($result as $row) {
            $id_produit = $row['id_produit'];
            $nom_produit = $row['nom_produit'];
            $produit_image  = $row['produit_image'];
            $produit_prix = $row['produit_prix'];
            $produit_ingredients = $row['produit_ingredients'];

            echo ' <div class="col-12 col-md-6 col-lg-4 mb-3 ">';



            if ($produit_image == '') {
                // Display an error message 
                echo 'image nexiste pas';
            } else {


                // Display the image
                echo '<img src="' . SITEURL . 'img/produit/' . $produit_image . '" class="img-curvy img-thumbnail img-responsive" style="background-color:#28a745; border-color:#28a745;">';
                echo '<div class="accordion accordion-flush my-2 mx-auto" id="accordionP6" style="width:50%">';
                echo '<div class="accordion-item bg-success">';
                '<h2 class="accordion-header" id="flush-head-accordionP6">';

                echo ' <button class="accordion-button collapsed btn" type="button" data-bs-toggle="collapse" data-bs-target="#flush-accordionP6" aria-expanded="false" aria-controls="flush-accordionP6" style="background-color: #0a5846ab; color: #fff">' . $produit_prix . ' €' .
                    '</button>';
                echo ' </h2>';

                echo   ' <div id="flush-accordionP6" class="accordion-collapse collapse bg-success" aria-labelledby="flush-head-accordionP6" data-bs-parent="#accordionP6">';
                echo '<div class="accordion-body">';
                echo  ' <p>'  . $produit_ingredients . '</p>';
                echo            '</div>';
                echo    ' </div>';
                echo ' </div>';
                echo '</div>';
            }

            echo '</div>';
        }

        echo '</div>';
    }
    ?>


=======
    <div class="row text-center">
        <div class="col-12 col-md-6 col-lg-4 mb-3">
            <img src="img/pizza-napolitaine-300.jpg" alt="pizza" class="img-curvy img-thumbnail" oneclick="" style="background-color:#28a745; border-color:#28a745;">
            <!-- accordeon -->
            <div class="accordion accordion-flush my-2 mx-auto" id="accordionP1" style="width:50%">
                <div class="accordion-item bg-success">
                    <h2 class="accordion-header" id="flush-head-accordionP">
                        <button class="accordion-button collapsed btn btn-success boutonA" id="boutonA" type="button" data-bs-toggle="collapse" data-bs-target="#flush-accordionP1" aria-expanded="false" aria-controls="flush-accordionP1" style="background-color: #0a5846ab; color: #fff">
                            Napolitaine 9.99€

                            <?php

                            ?>

                        </button>
                    </h2>
                    <div id="flush-accordionP1" class="accordion-collapse collapse bg-success activeVert" aria-labelledby="flush-head-accordionP" data-bs-parent="#accordionP1">
                        <div class="accordion-body">
                            <p> Tomates fraîches, fromage, basilic

                                <?php

                                ?>

                            </p>
                        </div>
                    </div>
                </div>
            </div> <!-- Fin accordeon -->
        </div> <!-- Fin de col card -->

        <div class="col-12 col-md-6 col-lg-4 mb-3">
            <img src="img/pizza-300.jpg" alt="pizza" class="img-curvy img-thumbnail" style="background-color:#28a745; border-color:#28a745;">
            <!-- accordeon -->
            <div class="accordion accordion-flush my-2 mx-auto" id="accordionP2" style="width:50%">
                <div class="accordion-item bg-success">
                    <h2 class="accordion-header" id="flush-head-accordionP2">
                        <button class="accordion-button collapsed btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#flush-accordionP2" aria-expanded="false" aria-controls="flush-accordionP2" style="background-color: #0a5846ab; color: #fff">
                            Reine 11.98€

                            <?php

                            ?>

                        </button>
                    </h2>
                    <div id="flush-accordionP2" class="accordion-collapse collapse bg-success" aria-labelledby="flush-head-accordionP2" data-bs-parent="#accordionP2">
                        <div class="accordion-body">
                            <p> Tomates fraîches, fromage, champignon de Paris, basilic

                                <?php

                                ?>

                            </p>
                        </div>
                    </div>
                </div>
            </div> <!-- Fin accordeon -->
        </div><!-- Fin de col card -->

        <div class="col-12 col-md-6 col-lg-4 mb-3">
            <img src="img/pizza3-300.jpg" alt="pizza" class="img-curvy img-thumbnail" style="background-color:#28a745; border-color:#28a745;">
            <!-- accordeon -->
            <div class="accordion accordion-flush my-2 mx-auto" id="accordionP3" style="width:50%">
                <div class="accordion-item bg-success">
                    <h2 class="accordion-header" id="flush-head-accordionP3">
                        <button class="accordion-button collapsed btn" type="button" data-bs-toggle="collapse" data-bs-target="#flush-accordionP3" aria-expanded="false" aria-controls="flush-accordionP3" style="background-color: #0a5846ab; color: #fff">
                            Reine du Sud 12.56€

                            <?php

                            ?>

                        </button>
                    </h2>
                    <div id="flush-accordionP3" class="accordion-collapse collapse bg-success" aria-labelledby="flush-head-accordionP3" data-bs-parent="#accordionP3">
                        <div class="accordion-body">
                            <p> Tomates fraîches, fromage, champignon de Paris, poivrons, basilic

                                <?php

                                ?>

                            </p>
                        </div>
                    </div>
                </div>
            </div> <!-- Fin accordeon -->
        </div><!-- Fin de col card -->

        <div class="col-12 col-md-6 col-lg-4 mb-3">
            <img src="img/pizza4-300.jpg" alt="pizza" class="img-curvy img-thumbnail" style="background-color:#28a745; border-color:#28a745;">
            <!-- accordeon -->
            <div class="accordion accordion-flush my-2 mx-auto" id="accordionP4" style="width:50%">
                <div class="accordion-item bg-success">
                    <h2 class="accordion-header" id="flush-head-accordionP4">
                        <button class="accordion-button collapsed btn" type="button" data-bs-toggle="collapse" data-bs-target="#flush-accordionP4" aria-expanded="false" aria-controls="flush-accordionP4" style="background-color: #0a5846ab; color: #fff">
                            4 fromages 8.99€

                            <?php

                            ?>

                        </button>
                    </h2>
                    <div id="flush-accordionP4" class="accordion-collapse collapse bg-success" aria-labelledby="flush-head-accordionP4" data-bs-parent="#accordionP4">
                        <div class="accordion-body">
                            <p> Tomates fraîches, mozarella, parmesan, chèvre, tome

                                <?php

                                ?>

                            </p>
                        </div>
                    </div>
                </div>
            </div> <!-- Fin accordeon -->
        </div><!-- Fin de col card -->

        <div class="col-12 col-md-6 col-lg-4 mb-3">
            <img src="img/pizza5-300.jpg" alt="pizza" class="img-curvy img-thumbnail" style="background-color:#28a745; border-color:#28a745;">
            <!-- accordeon -->
            <div class="accordion accordion-flush my-2 mx-auto" id="accordionP5" style="width:50%">
                <div class="accordion-item bg-success">
                    <h2 class="accordion-header" id="flush-head-accordionP5">
                        <button class="accordion-button collapsed btn" type="button" data-bs-toggle="collapse" data-bs-target="#flush-accordionP5" aria-expanded="false" aria-controls="flush-accordionP5" style="background-color: #0a5846ab; color: #fff">
                            Chorizo Party 15.56€

                            <?php

                            ?>

                        </button>
                    </h2>
                    <div id="flush-accordionP5" class="accordion-collapse collapse bg-success" aria-labelledby="flush-head-accordionP5" data-bs-parent="#accordionP5">
                        <div class="accordion-body">
                            <p> Tomates fraîches, fromage, chorizo à partager

                                <?php

                                ?>

                            </p>
                        </div>
                    </div>
                </div>
            </div> <!-- Fin accordeon -->
        </div><!-- Fin de col card -->

        <div class="col-12 col-md-6 col-lg-4 mb-3">
            <img src="img/pizza6-300.jpg" alt="pizza" class="img-curvy img-thumbnail" style="background-color:#28a745; border-color:#28a745;">
            <!-- accordeon -->
            <div class="accordion accordion-flush my-2 mx-auto" id="accordionP6" style="width:50%">
                <div class="accordion-item bg-success">
                    <h2 class="accordion-header" id="flush-head-accordionP6">
                        <button class="accordion-button collapsed btn" type="button" data-bs-toggle="collapse" data-bs-target="#flush-accordionP6" aria-expanded="false" aria-controls="flush-accordionP6" style="background-color: #0a5846ab; color: #fff">
                            Calzone 11.52€

                            <?php

                            ?>

                        </button>
                    </h2>
                    <div id="flush-accordionP6" class="accordion-collapse collapse bg-success" aria-labelledby="flush-head-accordionP6" data-bs-parent="#accordionP6">
                        <div class="accordion-body">
                            <p> Tomates fraîches, fromage, basilic

                                <?php

                                ?>

                            </p>
                        </div>
                    </div>
                </div>
            </div> <!-- Fin accordeon -->
        </div><!-- Fin de col card -->
    </div>
>>>>>>> Stashed changes
</div>
<?php
include_once 'inc/bas.php';
?>