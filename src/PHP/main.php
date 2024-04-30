<?php
require("connection.php");
//Garder la session en cours
session_start();
// Vérifie si l'utilisateur est connecté
if (isset($_SESSION['username'])) {
    // ajouter la var d'env $_SESSION en tant que var global pour l'environnement twig
    $twig->addGlobal('session', $_SESSION);
}
// Se rendre à la page main
echo $twig->render('main.twig'); 