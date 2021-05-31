<?php
// gestion de la newsletter
if (isset($_POST['newsletterform'])) {
    if (isset($_POST['newsletter'])) {
        if (!empty($_POST['newsletter'])) {
            $newsletter = htmlspecialchars($_POST['newsletter']);
            if (filter_var($newsletter, FILTER_VALIDATE_EMAIL)) {
                $reqip = $pdoSITE->prepare("SELECT * FROM newsletter WHERE ip = ?");
                $reqip->execute(array($_SERVER['REMOTE_ADDR']));
                $ipexist = $reqip->rowCount();
                if ($ipexist == 0) {
                    $reqmail = $pdoSITE->prepare("SELECT * FROM newsletter WHERE email = ?");
                    $reqmail->execute(array($newsletter));
                    $mailexist = $reqmail->rowCount();
                    if ($mailexist == 0) {
                        $sql = $pdoSITE->prepare('INSERT INTO newsletter(email,ip,dates) VALUES (?,?,NOW())');
                        $sql->execute(array($newsletter, $_SERVER['REMOTE_ADDR']));
                        header("location: index.php");
                    } else {
                        $erreur = "Vous êtes déjà inscrit à la Newsletter..";
                    }
                } else {
                    $erreur = "Vous êtes déjà inscrit à la Newsletter..";
                }
            } else {
                $erreur = "Vous devez indiquer une adresse e-mail..";
            }
        } else {
            $erreur = "Vous devez remplir tout les champs vides..";
        }
    }
}
?>


<!-- Footer -->
<footer class="text-center text-lg-start text-white container-fluid bg-dark">
    <!-- Grid container -->
    <div class="container-fluid pt-3">
        <!-- Section: Links -->
        <section class="">
            <!--Grid row-->
            <div class="row">
                <!-- Grid column -->
                <div class="col-md-3 col-lg-3 col-xl-3 d-none d-md-block d-lg-block ">
                    <h6><img src="img/logoBlanc.png" alt="logo-mixfood" class="img-fluid  mixfooter align-center " width="35%" height="35%"></h6>
                </div>
                <!-- Grid column -->

                <hr class="w-100 clearfix d-md-none" />

                <!-- Grid column -->
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-5">
                    <h6 class="text-uppercase mb-4 font-weight-bold vert">Moyen de paiement</h6>
                    <p>
                        <a class="text-white ">Espèces</a>
                    </p>
                    <p>
                        <a class="text-white">Carte bancaire</a>
                    </p>
                </div>
                <!-- Grid column -->

                <hr class="w-100 clearfix d-md-none" />

                <!-- Grid column -->
                <hr class="w-100 clearfix d-md-none" />

                <!-- Grid column -->
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-5">
                    <a href="contact.php" class="vert">
                        <h6 class="text-uppercase mb-4 font-weight-bold vert">CONTACT</h6>
                    </a>
                    <p>
                        <a class="text-white" href="admin/connexion_client2.php">Connexion</a>
                    </p>
                    <p>
                        <a class="text-white" href="index.php">Menu</a>
                    </p>
                </div>
                <!-- Grid column -->

                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-5">
                    <div class="bbb-wrapper fl-wrap">
                        <div class="subcribe-form fl-wrap">
                            <p class="vert">Newsletter </p>
                            <form method="POST">
                                <label>Adresse e-mail</label><br />
                                <input type="email" name="newsletter" /><br /><br />
                                <input type="submit" name="newsletterform" value="Envoyer" />
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Grid column -->
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-5">
                    <h6 class="text-uppercase text-center mb-4 font-weight-bold vert">Suivez-nous</h6>
                    <!-- Facebook -->
                    <p class="text-center text-md-left mt-3"><a href="https://fr-fr.facebook.com/" target="_blank"><i class=" fab fa-facebook fa-5x icon-fb vert"></i></a></p>

                </div>
            </div>
            <!--Grid row-->
        </section>
        <!-- Section: Links -->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center">
        <p class="text-end mx-3 text-muted"> &copy;<?php echo date("Y");  ?><a href="#"> mixfood </a> tous droits réservés </p>
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->


<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
<script src="../../js/script.js"></script>

</body>

</html>