<?php

session_start();

// Définir des variables de session
$_SESSION['username'] = $_POST["username"];
$_SESSION['password'] = $_POST["password"];

// Accéder aux variables de session
$username = $_SESSION['username'];
$password = $_SESSION['password'];

require 'connection.php';

// Requête de selection des infos de la bdd correspondant aux identifiants entrés dans le formulaire
$queryusername = "SELECT username FROM \"users\" WHERE username = '$username' ";
$querypsw = "SELECT password_hash FROM \"users\" WHERE username = '$username' ";
$stmt_user = $dbh->query($queryusername);
$stmt_psw = $dbh->query($querypsw);


// Aller chercher les info dans la Bdd
$result_user = $stmt_user->fetchAll(PDO::FETCH_ASSOC);
$result_psw = $stmt_psw->fetchAll(PDO::FETCH_ASSOC);


// Comparaison mdp et username
if (count($result_psw) == 0){
    echo "Nom d'utilisateur incorrect : Connexion échouée";
}
else{
    // Récupérer le mot de passe hashé à partir de la base de données
    $hashed_password = $result_psw[0]['password_hash'];
    // Utilisation de password_verify lorsque le mdp est hashé
    if ($password == $hashed_password ) {
        if ($username == 'admin'){
            echo "Connexion à la session administrateur";
        }
        else{
            echo "Connexion à la session utilisateur";
        }   
    } else {
        echo "Mot de passe incorrect : Connexion échouée";
    }
}
?>