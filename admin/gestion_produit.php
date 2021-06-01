<?php

require_once 'inc/init.php';
require_once 'inc/functions.php';
require_once 'inc/haut.php';

?>
<!-- menu principal -->
<main class="container">
    <h1 class="titreChoix text-center">Vos produits</h1>

    <div class="container m-auto my-5">

        <!-- button to ad admin  -->
        <a href="<?php echo SITEURL; ?>admin/ajouter_produit.php" class="btn btn-success my-2"><i class="fas fa-folder-plus"></i> Ajouter produit</a>

        <table class="table table-striped mx-auto table-success">
            <thead class="table-success">
                <tr>
                    <!-- <th scope="col">ID</th> -->
                    <th scope="col">Catégorie</th>
                    <th scope="col">Produit</th>
                    <th scope="col">Image</th>
                    <th scope="col">Ingredients</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Disponible</th>
                    <th scope="col">Produit vedette</th>
                    <th scope="col">Modifier</th>
                    <th scope="col">Supprimer</th>
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
                $nbr_produit = $sql->rowCount();

                if ($nbr_produit > 0) {
                    // there are record in the database

                } else {
                    // no record found in the database
                }


                foreach ($result as $row) {


                    $sql_cat_nam =  $pdoSITE->prepare("SELECT * FROM produit_categorie WHERE `id_categorie` = " . $row['id_categorie'] . ";");

                    $sql_cat_nam->execute();
                    $cat_res = $sql_cat_nam->fetchAll();
                    $cat_name = $cat_res[0]["nom_categorie"];

                    $produit_image  = $row['produit_image'];

                    echo "<tr>";

                    echo "<td>" . $cat_name . "</td>";
                    // echo "<td>" . $row['nom_categorie'] . "</td>";
                    echo "<td>" . $row['nom_produit'] . "</td>";

                ?>
                    <td>
                        <?php

                        if ($produit_image  != '') {
                        ?>
                            <img class="img-fluid" src="<?php echo SITEURL; ?>img/produit/<?php echo $produit_image; ?>">

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
                    echo "<td> <a href=\"modifier_produit.php?id_produit=" . $row['id_produit'] . "\" class=\"btn btn-success \"><i class=\"fas fa-user-edit\"></i></a></td>";
                    // ici on fait on modal situé plus bas
                    // cette modal ajoute un averstissement de plus
                    // cette une fonctionnalité de sécurité utilse
                    echo "<td> <a data-bs-toggle=\"modal\" href=\"#modal\" class=\" btn btn-danger\"><i class=\" fas fa-trash-alt\"></i></a></td><tr>";

                    // on bas c'est le modal 
                    // affiche un message important
                    ?>
                    <div class="modal" id="modal">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Supprimer ce produit</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-danger">
                                    <p class="text-danger">Attention! Action irréversible</p>
                                    <p class="text-danger">Êtes-vous sûr de vouloir supprimer ce produit ?</p>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">J'abondone</button>
                                    <!-- l'action de supprimer est activée ici -->
                                    <?php echo " <a href=\"supprimer_produit.php?id_produit=" . $row['id_produit'] . "\" class=\"btn btn-danger \"><i class=\"fas fa-trash-alt\"></i></a>"; ?>
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
</main>


<?php require_once 'inc/bas.php' ?>