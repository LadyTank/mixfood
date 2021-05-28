<?php
include 'inc/init.php';
include_once 'inc/haut.php';

$sql =  $pdoSITE->prepare("SELECT * FROM produit WHERE produit_vedette='oui' AND produit_disponible ='oui' AND nom_produit ='pizza' " );
 
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


    <div class="row text-center">
        <!-- début card -->
        <?php
                        if ($nbr_food > 0) {
                            // there are record in the database
                            echo '<div class="col-12 col-md-6 col-lg-4 mb-3">';
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
                                    //echo '<img src="' . SITEURL . 'img/categorie/' . $nom_image . '" class="img-curvy img-thumbnail img-responsive" width="50%" height="50%" style="background-color:#28a745; border-color:#28a745;"></div>';
                                }
                            }
                            echo '</div>';
                        }
                        ?>
       
            <img src="img/pizza6-300.jpg" alt="pizza" class="img-curvy img-thumbnail" style="background-color:#28a745; border-color:#28a745;">
            <!-- accordeon -->
            <div class="accordion accordion-flush my-2 mx-auto" id="accordionP6" style="width:50%">
                <div class="accordion-item bg-success">
                    <h2 class="accordion-header" id="flush-head-accordionP6">
                        <button class="accordion-button collapsed btn" type="button" data-bs-toggle="collapse" data-bs-target="#flush-accordionP6" aria-expanded="false" aria-controls="flush-accordionP6" style="background-color: #0a5846ab; color: #fff">
                
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
</div>
<?php
include_once 'inc/bas.php';
?>