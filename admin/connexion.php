<?php

// Connexion à la BDD :

$host='localhost'; // Le chemin vers le serveur de données
$database='damien_portefolio'; // Le nom de l'utilisateur pou de connecter
$user='root'; // le nom de l'utilisateur pour se connecter
$password='';   // le mot de passe de l'utilisateur local (sur PC)
// $password='root' // mot de passe local (sur MAC)

$pdoCV = new PDO('mysql:host' . $host . ';dbname=' . $database,$user,$password);
// $pdoCV est le nom de la variable pour la connexion à la BDD qui nous sert partout où l'on doit se servir de cette connexion
$pdoCV->exec("SET NAMES utf8");


?>
