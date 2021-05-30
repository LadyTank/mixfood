<?php
// connexion à la bdd

define('SITEURL', 'http://localhost/mixfood/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('MIXFOOD', 'mixfood');

try {
    $access  = new PDO("mysql:host=LOCALHOST; dbname=MIXFOOD;charset=utf8", DB_USERNAME, DB_PASSWORD);
    $access->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch (Exception $e) {
    $e->getMessage();
}
