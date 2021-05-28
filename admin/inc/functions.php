<?php


///////////// 1- FONCTION var_dump     //////////////////
function jevardump($maVariable)
{ //la fonction nommée avec son paraétre, une variable
    echo "<pre><span class=\"bg-danger text-white p-2\">..var_dump</span>";
    echo "<p class=\"alert alert-success p-2 \">";
    var_dump($maVariable); //une variable à laquelle on applique la fonction var_dump
    echo "</p></pre>";
}

///////////// 1- FONCTION print_r     //////////////////

//création d'une fonction pour "print_r" une varialble (très utile pour un tableau)
function jeprint_r($maVariable)
{ //la fonction nommée avec son paraétre, une variable
    echo "<pre><span class=\"bg-danger text-white p-2\">..print_r</span>";
    echo "<p class=\"alert alert-warning p-2 w-50\">";
    print_r($maVariable); //une variable à laquelle on applique la fonction print_r
    echo "</p></pre>";
}


///////////// 2- FONCTION POUR EXECUTER LES prepare()     //////////////////

function executeRequete($requete, $parametres = array())
{ // utile pour toutes les requête du site
    foreach ($parametres as $indice => $valeur) {  // foreach      
        $parametres[$indice] = htmlspecialchars($valeur); // on evite les injections SQL
        global $pdoSITE; // global nous permet de rendre la variable $pdoSITE accessible dans l'espace global du project
        $resultat = $pdoSITE->prepare($requete); // puis prepare prépare la requête
        $succes = $resultat->execute($parametres);
        if ($succes === false) {
            return false; // si la requête  n'a pas marché je renvoie false
        } else {
            return $resultat;
        } // fin if else 
    }
} // fermeture fonction executeRequete


////////// 3 - VERIFIER SI LE MEMBRE EST CONNECTE //////////////

function estConnecte()
{
    if (isset($_SESSION['utilisateur'])) {
        return true; //il est connecté
    } else {
        return false; // il n'est pas connecté
    }
}

////////// 4 - VERIFIER LE STATUT DU MEMBRE //////////////

function estAdmin()
{
    if (estConnecte() && $_SESSION['utilisateur']['statut_utilisateur'] == 'admin') {
        return true;
    } else {
        return false;
    }
}
