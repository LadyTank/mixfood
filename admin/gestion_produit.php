<?php

require_once 'inc/init.php';
require_once 'inc/functions.php';
require_once 'inc/haut.php';

?>
<!-- menu principal -->
<div class="container m-auto">

    <!-- button to ad admin  -->
    <a href="<?php echo SITEURL; ?>admin/ajouter_produit.php" class="btn btn-success my-2"><i class="fas fa-folder-plus"></i> un produit</a>

    <table class="table table-striped mx-auto">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Categorie</th>
                <th>Produit</th>
                <th>Image</th>
                <th>Ingredients</th>
                <th>Prix</th>
                <th>Disponible</th>
                <th>Produit vedette</th>
                <th>Modifier</th>
                <th>Supprimer</th>
           


            </tr>
        </thead>
        <tbody>
            <?php
            // Query to get all Categories from database
            $sql =  $pdoSITE->prepare("SELECT * FROM produit");

            //execute the sql statement as an object NOT an array

            $sql->execute();

            // fetch all rows into array, by default PDO::FETCH_BOTH is used
            $result =   $sql->fetchAll();
            //var_dump($result);

            // count the number of admin in the database
            $nbr_produit =      $sql->rowCount();

            if ($nbr_produit > 0) {
                // there are record in the database

            } else {
                // no record found in the database
            }




            foreach ($result as $row) {

                $produit_image  = $row['produit_image'];

                echo    "<tr>";

                echo "<td>" . $row['id_produit'] . "</td>";
                echo "<td>" . $row['id_categorie'] . "</td>";
                echo "<td>" . $row['nom_produit'] . "</td>";

            ?>
                <td>
                    <?php

                    if ($produit_image  != '') {
                    ?>
                        <img src="<?php echo SITEURL; ?>img/produit/<?php echo $produit_image; ?>" width="100px">


                    <?php

                    } else {
                        echo  "<div class=\"alert alert-warning row col-col-4\">Image n'a pas été télécharger</div>";
                    }

                    ?>
                </td>
            <?php
                // affichage des donnés correspendant à chaque produit
                echo " <td>" . $row['produit_ingredients'] . "</td>";
                echo " <td>" . $row['produit_prix'] . "</td>";
                echo "<td>" . $row['produit_vedette'] . "</td>";
                echo "<td>" . $row['produit_disponible'] . "</td>";
                // liens vers la modification du produit
                echo "<td> <a href=\"modifier_produit.php?id_produit=" .$row['id_produit'] . "\" class=\"btn btn-warning \"><i class=\"fas fa-user-edit\"></i></a></td>";
                // ici on fait on modal situé plus bas
                // cette modal ajoute un averstissement de plus
                // cette une fonctionnalité de sécurité utilse
                echo '<td> <a data-bs-toggle="modal" href="#modal_'.$row['id_produit'].'" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a></td>';// on appelle la modal ici via son id
                
                echo    "</tr>";

                // on bas c'est le modal 
                // affiche un message important
                ?> 
                
                <div class="modal" id="modal_<?php echo $row['id_produit']; ?>">// on renomme les id à chaque itération
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title">Supprimer ce produit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-danger">
                        <p class="text-danger">Attention! vous êtes sur le point de faire une action irreversible</p>
                        <p class="text-danger">Etes vous sûr de vouloir supprimer ce produit ?</p>
                    
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">J'abandonne</button>
                        <!-- l'action de supprimer est activée ici -->
                        <?php echo " <a href=\"supprimer_produit.php?id_produit=" .$row['id_produit']. "\" class=\"btn btn-danger \"><i class=\"fas fa-trash-alt\"></i> </a>"; ?>
                        </div>
                    </div>
                </div>
                </div>
                <?php
            }
            ?>

        </tbody>
    </table>

</div>


<?php require_once 'inc/bas.php' ?>
