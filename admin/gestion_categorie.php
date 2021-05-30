<?php

require_once 'inc/init.php';
require_once 'inc/functions.php';
require_once 'inc/haut.php';


?>
<!-- menu principal -->
<div class="container m-auto">
    <?php 
    // on active la session de suppression de category
    if(isset($_SESSION['supprimer'])){
        echo $_SESSION['supprimer'];
        unset($_SESSION['supprimer']);

    }

    // on active la session d'ajout de category
    if(isset($_SESSION['ajouter_cat'])){
        echo $_SESSION['ajouter_cat'];
        unset($_SESSION['ajouter_cat']);
    }

    // on active la session 
    if(isset( $_SESSION['telecharger'] )){
        echo  $_SESSION['telecharger'];
        unset( $_SESSION['telecharger']);
    }

    if(isset($_SESSION['actualiser'])){
        echo $_SESSION['actualiser'];
        unset($_SESSION['actualiser']);
    }


    ?>

    <!-- button to ad admin  -->
    <a href="<?php echo SITEURL; ?>admin/ajouter_categorie.php" class="btn btn-primary my-2"><i class="fas fa-folder-plus"></i> une categorie</a>
   
   
    <table class="table table-striped mx-auto">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Categorie</th>
                <th>Image</th>
                <th>Category vedette</th>
                <th>Disponible</th>
                <th>Modifier</th>
                <th>Supprimer</th>


            </tr>
        </thead>
        <tbody>
            <?php
            // Query to get all Categories from database
            $sql =  $pdoSITE->prepare("SELECT * FROM produit_categorie");

            //execute the sql statement as an object NOT an array

            $sql->execute();

            // fetch all rows into array, by default PDO::FETCH_BOTH is used
            $result =   $sql->fetchAll();
            //var_dump($result);

            // count the number of admin in the database
            $nbr_category =      $sql->rowCount();

            if ($nbr_category > 0) {
                // there are record in the database

            } else {
                // no record found in the database
            }



            foreach ($result as $row) {

                $nom_image = $row['nom_image'];

                echo    "<tr>";

                echo "<td>" . $row['id_categorie'] . "</td>";
                echo "<td>" . $row['nom_categorie'] . "</td>";

            ?>
                <td>
                    <?php

                    if ($nom_image != '') {
                    ?>
                    <!-- mettre l'image en php et reduire ce passage html -->
                        <img src="<?php echo SITEURL; ?>img/categorie/<?php echo $nom_image; ?>" width="100px">


                        <?php

                        ?>
                </td>
            <?php
                       
                    }
            ?>

            </td>
        <?php
                echo "<td>" . $row['en_vedette'] . "</td>";
                echo "<td>" . $row['disponible'] . "</td>";
                echo "<td> <a href=\"modifier_categorie.php?id_categorie=" . $row['id_categorie'] .  "\" class=\"btn btn-warning \" ><i class=\"fas fa-user-edit\"></i> la gategorie</a></td>";
            
                echo "<td> <a data-bs-toggle=\"modal\" href=\"#modal\" class=\" btn btn-danger\"><i class=\" fas fa-trash-alt\"></i> la categorie  </a></td>";
                echo    "<tr>";

        ?>
                   <div class="modal" id="modal">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title">Supprimer la catégorie</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-danger">
                        <p class="text-danger">Attention! vous êtes sur le point de faire une action irreversible</p>
                        <p class="text-danger">Etes vous sûr de vouloir supprimerce cette gatégorie ?</p>
                    
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">J'abondone</button>
                        <!-- l'action de supprimer est activée ici -->
                        <?php echo "<a href=\"supprimer_categorie.php?id_categorie=" . $row['id_categorie'] . "\" class=\"btn btn-danger \" ><i class=\"fas fa-trash-alt\"></i> la gategorie</a>"?>
                        </div>
                    </div>
                </div>
                </div>
        
        
        
        
        
        <?php





            }
        ?>


        </tbody>
    </table>





<?php require_once 'inc/bas.php' ?>
