<?php
include 'inc/init.php';
include 'inc/haut.php';
?>

<div class="container m-5 p-4 mx-auto">
    <h3 class="text-center titreChoix text-light">Contact</h3>
    <p class="text-center mb-5 "><em>Parce que votre avis nous intéresse</em></p>
    <div class="row">
        <div class="col-md-3 col-sm-12 col-lg-3">
            <p>Laissez nous un commentaire</p>
            <p><span class="glyphicon glyphicon-map-marker"></span>Suresnes</p>
            <p><span class="glyphicon glyphicon-phone"></span>Téléphone : 01.42.52.24.25</p>
            <p><span class="glyphicon glyphicon-envelope"></span>Mail: mixfood@mail.com</p>
        </div>
        <div class="col-md-6 col-sm-12 col-lg-6">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-lg-6 form-group mb-4">
                    <input class="form-control" id="name" name="name" placeholder="Votre nom et prénom" type="text" required>
                </div>
                <div class="col-xs-12 col-sm-12 col-lg-6 form-group mb-4">
                    <input class="form-control" id="email" name="email" placeholder="Votre email" type="email" required>
                </div>
            </div>
            <textarea class="form-control mb-4" id="comments" name="comments" placeholder="Votre message" rows="5"></textarea>

            <div class="col">
                <button class="btn btn-success border border-light mr-1 mb-1 mx-auto col-sm-3 float-end" id="btn-envoyer">Envoyer</button>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 form-group ">
            <img src="img/sushiDessin4.png" alt="dessin sushi contact" class="img-fluid">
        </div>
    </div> <!-- fin de row-->
    <div class="col mx-auto text-center mt-4 map-responsive rounded" id="coin">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.8645312510744!2d2.211644869512095!3d48.860793583226375!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e664cb18235a55%3A0x21fc823972e9be9c!2sCoton%20Fabrice!5e0!3m2!1sfr!2sfr!4v1621975926145!5m2!1sfr!2sfr" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
</div> <!-- fin de container-->
<?php
include 'inc/bas.php';
?>