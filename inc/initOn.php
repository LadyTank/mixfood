<?php
// init 
// fichier indispensable au fonctionnement 

/////////  Connexion a la base de données  ///////////
// la racine
define('SITEURL', 'http://audrey-saulnier.fr/');
define('LOCALHOST', 'ftp.cluster029.hosting.ovh.net');
define('DB_USERNAME', 'audreyj');
define('DB_PASSWORD', 'AMdK8H46UUry');
define('MIXFOOD', 'mixfood');


$pdoSITE  = new PDO("mysql:host=audreyjtanky.mysql.db; dbname=audreyjtanky", DB_USERNAME, DB_PASSWORD);
$pdoSITE->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// ///////// OUVERTURE DE SESSION ///////// //
session_start();

// ///////// 4 - VARIABLE POUR LES CONTENUS ///////// //
$message = ''; // déclaration d'une variable pour introduire une variable vide
$contenu = '';

// ///////// 5 - INCLUSION DES FONCTIONS ///////// //
require_once 'functions.php';
