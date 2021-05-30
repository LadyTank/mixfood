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
            
                echo "<td> <button <a href=\"supprimer_categorie.php?id_categorie=" . $row['id_categorie'] . "\" class=\"btn btn-danger \" ><i class=\"fas fa-trash-alt\"></i> la gategorie</a></button></td>";
                echo    "<tr>";
            }
        ?>


        </tbody>
    </table>


        <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                    </div>
                
                    <div class="modal-body">
                        <p>You are about to delete one track, this procedure is irreversible.</p>
                        <p>Do you want to proceed?</p>
                        <p class="debug-url"></p>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-danger btn-ok">Delete</a>
                    </div>
                </div>
            </div>
        </div>

    </div>


<?php require_once 'inc/bas.php' ?>
