<?php
// init 
// fichier indispensable au fonctionnement 

/////////  Connexion a la base de données  ///////////
// la racine
define('SITEURL', 'http://localhost/mixfood/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('MIXFOOD', 'mixfood');


$pdoSITE  = new PDO("mysql:host=LOCALHOST; dbname=MIXFOOD", DB_USERNAME, DB_PASSWORD);
$pdoSITE->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// $pdoSITE = new PDO(
//     'mysql:host=localhost;dbname=mixfood',
//     'root',
//     '',
//     array(
//         PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
//         PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
//     )
// );

// ///////// INCLUSION DES FONCTIONS ///////// //
require_once 'functions.php';

// ///////// OUVERTURE DE SESSION ///////// //
session_start();

// /////////VARIABLE POUR LES CONTENUS ///////// //
$message = ''; // déclaration d'une variable pour introduire une variable vide
$contenu = '';
