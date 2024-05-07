<?php 

/* Fonction qui vérifie si les champs sont vides */
function EmptyField($username, $password) {
    if (empty($username) || empty($password)) {
        return true; // Retourne vrai si un champ est vide
    } else {
        return false; // Retourne faux si tous les champs sont remplis
    }
}

/* Fonction qui vérifie si le password est correct pour ce username */
function checkPassword($username, $password, $dbh) {
    // Aller chercher le password associé au username
    $querypsw = "SELECT password_hash FROM \"users\" WHERE username = '$username' ";
    $stmt_psw = $dbh->query($querypsw);
    $result_psw = $stmt_psw->fetchAll(PDO::FETCH_ASSOC);
    // Récupérer le mot de passe hashé à partir de la base de données
    $hashed_password = $result_psw[0]['password_hash'];
    if ($password === $hashed_password) {
        return true; // Les mots de passe correspondent, retourne vrai
    } else {
        return false; // Les mots de passe ne correspondent pas, retourne faux
    }
}


/* Fonction qui vérifie si le username existe déjà dans la base de donnée */
function if_username_exist($username, $dbh){
    $ret = false;
    // Aller chercher les infos dans la bdd
    $queryusernames = "SELECT * FROM users WHERE username = '$username' ";
    $stmt = $dbh->query($queryusernames);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Si cela existe
    if(($result)){
        $ret = true;
    }
    return $ret;
}
