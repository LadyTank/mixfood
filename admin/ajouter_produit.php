<?php
require_once 'inc/init.php';
require_once 'inc/functions.php';
if (!empty($_POST)) {
    //On verifie que le formulaire a bien été envoyé
    // on nettoie le formulaire en utilisant htmlspecialchars
    $nom_produit =  htmlspecialchars($_POST['nom_produit']);
    $produit_prix = htmlspecialchars($_POST['produit_prix']);
    $produit_ingredients = htmlspecialchars($_POST['produit_ingredients']);
    $id_categorie = $_POST['categorie'];
    // On verifie le bouton radio selectionné
    if (isset($_POST['produit_vedette'])) {
        $produit_vedette =  htmlspecialchars($_POST['produit_vedette']);
    } else {
        $produit_vedette = "non";
    }
    // on verifie si le     nom_produit va être en produit_disponible  ou bon
    if (isset($_POST['produit_disponible'])) {
        $produit_disponible  =  htmlspecialchars($_POST['produit_disponible']);
    } else {
        $produit_disponible  = "non";
    }
    // TRAITEMENT DES IMAGES
    // On verifie si les images sont selectionnées
    //print_r($_FILES['produit_image']['name']);
    //die();
    // var_dump( $produit_image);
    //die();
    if (isset($_FILES['produit_image']['name'])) {
        $produit_image = htmlspecialchars($_FILES['produit_image']['name']); //produit_image
        if ($produit_image != "") {
            // auto rename OUR image
            // get the extension of our image (jpg, png ,gif, etc) e.g "special.food.jpg"
            $tmp = explode('.', $produit_image);
            $file_extension = end($tmp);
            // renomme les images
            $produit_image = "Produit_mixfood" . rand(000, 999) . '.' . $file_extension; // e.g => Food_category_232.jpg
            $source_path = $_FILES['produit_image']['tmp_name']; // source path (source du fichier)
            //var_dump($source_path);
            $destination_path = "../img/produit/" . $produit_image; // destination path (destination du fichier)
            // Now we can Upload the file( on televerse cette image de la source at le destination)
            $upload = move_uploaded_file($source_path, $destination_path);
            if ($upload == false) {
                // SET message
                $_SESSION['upload'] = "<div class=\"alert alert-danger\">Image Failed to upload</div>";
                // redirect to add Category page
                header('location:' . SITEURL . 'admin/ajouter_produit.php');
                // STOP 
                die();
            }
        }
    } else {
        $produit_image = "";
    }
    // 2. On prepare la requête sql . Les données seront persister des que le bouton submit est activé
    $sql1 = $pdoSITE->prepare("INSERT INTO produit SET  id_categorie='$id_categorie', nom_produit ='$nom_produit', produit_image ='$produit_image',  produit_ingredients='$produit_ingredients',produit_prix='$produit_prix', produit_vedette='$produit_vedette',produit_disponible ='$produit_disponible' ");
    //var_dump( $sql1);
    // On execute la requête
    $requete = $sql1->execute();
    //var_dump($requete);
    if ($requete  == TRUE) {
        // cQuery executed correctly and data added to the database
        $_SESSION['add'] =  " <div class=\"alert alert-success row col-col-4\">Category Successfully Added</div>"; // create a new section called 'add'
        header('location:' . SITEURL . 'admin/gestion_produit.php');
        exit;
    } else {
        //Failed to add category
        $_SESSION['add'] = "<div class=\"alert alert-success row col-col-4\">Category Failed to  Added</div>";
        header('location:' . SITEURL . 'admin/ajouter_produit.php');
        exit;
    }
}
require_once 'inc/haut.php';
?>
<div class="container m-auto">
    <div class="row">
        <!-- début row -->
        <div class="col-sm-12 col-md-6 m-auto my-5 p-5">
            <div class="card m-auto alert alert-success p-5">
                <h2 class="bg-light p-4 text-center mb-5">Nouveau produit</h2>
                <!-- début de formulaire -->
                <form method="POST" action="" enctype="multipart/form-data" class="">
                    <div class="form-group mb-3">
                        <label for="nom_produit"> Nom du produit</label>
                        <input type="text " class="form-control text-right" name="nom_produit" id="nom_produit">
                    </div>
                    <div class="form-group mb-3">
                        <label for="produit_prix">Prix</label>
                        <input type="text " class="form-control text-right" name="produit_prix" id="produit_prix">
                    </div>
                    <div class="form-group mb-3">
                        <label for="produit_image">Choisir une image</label>
                        <input type="file" class="form-control text-right" name="produit_image" id="produit_image">
                    </div>
                    <div class="form-group mb-3">
                        <label for="produit_categorie" class="bg-warning text-dark"><i class="fas fa-exclamation-triangle"></i>Quelle est sa catégorie ?</label>
                        <select class="form-select form-select-sm" name="categorie" id="categorie" aria-label="choix categorie">
                            <option value="">....</option>';
                            <?php
                            // on recupere toutes les catégorie
                            $sql =  $pdoSITE->prepare("SELECT * FROM produit_categorie WHERE disponible = 'oui' ");
                            // on execute la requete
                            $sql->execute();
                            // on assigne toutes les données dans a $requete, by default PDO::FETCH_BOTH is used
                            $result =   $sql->fetchAll();
                            //print_r($result);
                            // compte le nombre de catégorie
                            $count_nbr_cat =  $sql->rowCount();
                            if ($count_nbr_cat > 0) {
                                // pour chaque categories dans la bdd, on affiche ID et le nom comme option
                                foreach ($result as $row) {
                                    $id_categorie = $row['id_categorie'];
                                    $nom_categorie = $row['nom_categorie'];
                            ?> ;
                                    <option value="<?php echo $id_categorie; ?>"><?php echo $nom_categorie; ?></option>';
                            <?php
                                }
                            } else {
                                echo ' <option value=\"0\">Categorie n\'existe pas</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="produit_ingredients" class="form-label">Ingrédients</label>
                        <textarea class="form-control text-right" name="produit_ingredients" id="produit_ingredients" rows="3"></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="produit_vedette">Produit vedette </label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio"  name="produit_vedette" id="produit_vedette" value="oui">
                            <label class="form-check-label" for="f">oui</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="produit_vedette" id="produit_vedette" value="non">
                            <label class="form-check-label" for="m">non</label>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="produit_vedette">Disponibilité du produit </label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="produit_disponible" id="produit_disponible" value="oui">
                            <label class="form-check-label" for="f">oui</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="produit_disponible" id="produit_disponible" value="non">
                            <label class="form-check-label" for="m">non</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-small btn-warning">AJOUTER</button>
                </form> <!-- fin de formulaire -->
            </div><!-- Fin de card -->
        </div><!-- Fin de col -->
    </div><!-- Fin row -->
</div> <!-- fin de container-->
<?php require_once 'inc/bas.php'; ?>