<?php
// gestion de la newsletter


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
                    <h6><img src="../img/logoBlanc.png" alt="logo-mixfood" class="img-fluid  mixfooter align-center " width="35%" height="35%"></h6>
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
                    <a href="../contact.php" class="vert">
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
                            <form id="subscribe" novalidate="true">
                                <input class="emailNews" name="email_news" id="email_news" placeholder="Votre email" spellcheck="false" type="text">

                                <i class="fa fa-rss btn btn-success subscribe-button" type="submit" id="subscribe-button"> GO</i>

                                <label for="subscribe-email" class="subscribe-message"></label>
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
        <p class="text-end mx-3 text-muted" id="pfooter"> &copy;<?php echo date("Y");  ?><a href="#"> mixfood </a> tous droits réservés </p>
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->


<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
<script src="../../js/script.js"></script>

<!-- Mes scripts !!! -->

<script>
    let boutonForm = document.querySelector('#cacheImage');

    let formModif = document.querySelector('.cache');

    function cliqueBouton() {
        formModif.classList.toggle('cache');
    }

    boutonForm.addEventListener('click', cliqueBouton);
</script>


</body>

</html>