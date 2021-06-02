<?php

//envoi d'email suite à une inscription
$entete = "From: Site Boutique <contact@audrey-saulnier.fr>\r\n"; // adresse email OVH qui sert à envoyer l'email
$entete .= "Reply-To: contact@audrey-saulnier.fr\r\n";
$entete .= "MIME-version: 1.0\r\n"; // 
$entete .= "Content-Type: text/html; charset=\"UTF-8\"" . "\n"; //utf 8 pour avoir les accents
$entete .= "Content-Transfer-Encoding: 8bit";
$corps = 'Nouvelle inscription site Boutique. : ' . $_POST['prenom'] . '  ' . $_POST['nom'] . ' vient de s\'inscrire.  ';
$corps .= "<br>Nom : " . $_POST['nom'] . '<br> ';
$corps .= "Prenom : " . $_POST['prenom'] . '<br>';
$corps .= "Email : " . $_POST['email'] . '<br>';
$corps .= "Adresse : " . $_POST['adresse'] . ' ';
$corps .= "Code postal : " . $_POST['code_postal'] . ' ';
$corps .= "Ville : " . $_POST['ville'] . '<br>';
//$corps.=" \nmessage : ".$_POST['message'];
//$nouvelinscrit.=' Prenom : '.$prenom.' '.$nom.''; //début du courriel
mail('isola.patrick@gmail.com,castellu@isola.name', 'Inscription de : ' . $_POST['nom'], $corps, $entete); //on fait un courriel pour Patrick avec le nom de l'inscrit dans l'objet
$corps_bis = 'Bonjour et bienvenue ' . $_POST['prenom'] . '  ' . $_POST['nom'] . '<br> Merci de votre inscription sur le site ...<br>';
$corps_bis .= 'Voici les informations que vous pourrez mettre à jour sur le site en vous identifiant : <br> ';
$corps_bis .= '<strong>' . $_POST['prenom'] . ' ';
$corps_bis .= ' ' . $_POST['prenom'] . '</strong><br>';
$corps_bis .= 'Email : ' . $_POST['email'] . '<br>';
$corps_bis .= 'Adresse : ' . $_POST['adresse'] . '<br>';
$corps_bis .= 'Code postal : ' . $_POST['code_postal'] . '<br>';
$corps_bis .= 'Ville : ' . $_POST['ville'] . '<br>';
// $corps_pourleclient.='Portable : '.$portable.'<br><br>';
// $corps_pourleclient.='Pour vous identifier sur le site : <br>votre courriel : <strong>'.$courriel.'</strong><br>';
// $corps_pourleclient.='et votre mot de passe : <strong>vous seul le connaissez !</strong><br><br><br>';
$corps_bis .= 'Rendez-vous sur la page de <a href=\"http://isola.name/boutique/connexion.php\">connexion</a> pour vous connecter.<br><br>';
$corps_bis .= '***************<br><br>';
// $corps_bis.='<a href=\"http://isola.name/boutique/connexion.php\">www.autojaunejunior.com</a><br><br>';
// $corps_bis.='<a href=\"mailto:castellu@isola.name\">contact@autojaunejunior.com</a><br>';
mail($_POST['email'], 'Votre inscription à la Boutique. ', $corps_bis, $entete);//on fait un courriel pour le client
// fin des emails pour l'admin et le client
