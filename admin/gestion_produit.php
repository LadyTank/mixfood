<?php

require_once 'inc/init.php';
require_once 'inc/functions.php';
require_once 'inc/haut.php';

?>
<!-- menu principal -->
<div class="container m-auto">

    <!-- button to ad admin  -->
    <a href="<?php echo SITEURL; ?>admin/ajouter_produit.php" class="btn btn-primary my-2"><i class="fas fa-folder-plus"></i> une categorie</a>

    <table class="table table-striped mx-auto">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Categorie</th>
                <th>Produit</th>
                <th>Image</th>
                <th>produit_ingredients</th>
                <th>produit_prix</th>
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
                echo " <td>" . $row['produit_ingredients'] . "</td>";
                echo " <td>" . $row['produit_prix'] . "</td>";
                echo "<td>" . $row['produit_vedette'] . "</td>";
                echo "<td>" . $row['produit_disponible'] . "</td>";
                echo "<td> <a href=\"modifier_produit.php?id_produit=" . $row['id_produit'] . "\" class=\"btn btn-warning \"><i class=\"fas fa-user-edit\"></i> le produit</a></td>";
                echo "<td> <a href=\"supprimer_produit.php?id_produit=" . $row['id_produit'] . "\" class=\"btn btn-danger \"><i class=\"fas fa-trash-alt\"></i> le produit</a></td>";
                echo    "<tr>";
            }
            ?>


        </tbody>
    </table>

</div>

<?php require_once 'inc/bas.php' ?>