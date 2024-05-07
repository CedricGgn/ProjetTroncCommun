<?php
/* Librairies */
include 'functions.php';

session_start();
require ("connection.php");

$message = "";
if (!(isset($_POST['username'])) && !(isset($_POST['password']))) {
    echo $twig->render('login.twig', [
        'content' => $message,
    ]);
}
else{
    // Récupérer les variables du formulaire de connexion 
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Conditions à respecter pour être connecté 
    if (!(EmptyField($username, $password))){
        if ((if_username_exist($username, $dbh))){
            if (checkPassword($username, $password, $dbh)){
                $_SESSION['username'] = $username;
                // ajouter la var d'env $_SESSION en tant que var global pour l'environnement twig
                $twig->addGlobal('session', $_SESSION);
                echo $twig->render('main.twig', [
                    'username' => $_SESSION['username']
                ]);
                exit();
            }
            else{
                $message = "Mot de passe incorrect, réessayez";
            }
        }
        else{
            $message = "Nom d'utilisateur incorrect, réessayez";
        }
    }
    else{
        $message = "Un ou plusieurs champs sont vides";
    }
    echo $twig->render('login.twig', [
        'content' => $message,
    ]);
    exit();
}
