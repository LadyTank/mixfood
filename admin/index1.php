<?php
require_once 'inc/init.php';
include_once 'inc/functions.php';

// sécurite pour le coté admin
// si l'utilisateur est admin il peut acceder avoir acces a cette page
// Seul les developpeurs peuvent acceder aux fichiers cache derriere ce mur
// if (estAdmin()) {
//     // redirigé vers mixfood/admin

//     echo $contenu .= '<div class="alert alert-danger">Bienvenue</div>';
//     header('location:' . SITEURL . 'admin/');
//     exit();
// } else {
//     //rediriger vers le l index cote front
//     header('location:' . SITEURL . 'index.php');
//     exit();
// }