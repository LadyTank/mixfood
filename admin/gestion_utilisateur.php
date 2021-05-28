<?php

require_once 'inc/init.php';
require_once 'inc/functions.php';
require_once 'inc/haut.php';




?>
<!-- menu principal -->
<div class="container m-auto">

    <!-- button to ad admin  -->
    <a href="<?php echo SITEURL; ?>admin/inscription_client.php" class="btn btn-primary my-2"><i class="fas fa-folder-plus"></i> un utilisateur</a>

    <div class="table-responsive">
        <table class="table table-striped bg-light table-sm mx-auto">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Adresse</th>
                    <th>Ville</th>
                    <th>Code Postale</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody cla>
                <?php
                // on récupère toutes les données utilisateur
                $requete = $pdoSITE->query(" SELECT * FROM utilisateur ORDER BY id_utilisateur DESC");
        
                //execute the sql statement as an object NOT an array
        
                $requete->execute();
        
                // fetch all rows into array, by default PDO::FETCH_BOTH is used
                $result =    $requete->fetchAll();
                //var_dump($result);
        
                // on compte le nombre d'utilisateur
                $nbr_utilisateur =  $requete->rowCount();
        
            
        
                foreach ( $result as $user) {
                    echo "<tr>";
                    echo "<td>" . $user['id_utilisateur'] . "</td>";
                    echo "<td>" . $user['prenom'] . "</td>";
                    echo "<td>" . $user['nom'] . " </td>";
                    echo "<td>" . $user['email'] . " </td>";
                    echo "<td>" . $user['telephone'] . " </td>";
                    echo "<td>" . $user['adresse'] . " </td>";
                    echo "<td>" . $user['ville'] . " </td>";
                    echo "<td>" . $user['code_postal'] . " </td>";
        
                    if ($user['statut_utilisateur'] == "admin") {
                        echo "<td class=\"badge bg-danger\">Administrateur</td>";
                    } else {
                        echo "<td class=\"badge bg-warning\">Client</td>";
                    }
        
                    echo "</tr>";
                }
                ?>
        
        
            </tbody>
        </table>
    </div>

</div>

<?php require_once 'inc/bas.php' ?>