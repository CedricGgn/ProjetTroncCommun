<?php

session_start();
require_once '../vendor/autoload.php';

// Récupérer les variables de session
$username  = $_POST["username"];
$password = $_POST["password"];

# Identifiants de connexion à la BDD
$db_host = $_ENV['DB_HOST'];
$db_name   = $_ENV['DB_DB'];
$user_con = $_ENV['DB_USER'];
$psw_con = $_ENV['DB_PASSWORD'];

# Connexion en utilisant PDO
try {
    $dbcon = new PDO("pgsql:host=$db_host;dbname=$db_name", $user_con, $psw_con);
    //echo "Connexion réussie \n";
} catch (PDOException $e) {
    echo "Erreur de connexion à la bdd: \n" . $e->getMessage();
}

// Requête de selection des infos de la bdd correspondant aux identifiants entrés dans le formulaire
$queryusername = "SELECT username FROM \"users\" WHERE username = '$username' ";
$querypsw = "SELECT password_hash FROM \"users\" WHERE username = '$username' ";
$stmt_user = $dbcon->query($queryusername);
$stmt_psw = $dbcon->query($querypsw);

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
        }
        else{
        }
        // Stocker dans la variable d'env pour manipuler sur le main
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;

        // Lire la variable d'environnement
        $isProduction = ($_SERVER['APP_ENV'] ?? '') === 'production';

        // Utilisation de la variable pour définir le cache dans Twig
        $twigCache = $isProduction ? '../cache' : false;
        $loader = new \Twig\Loader\FilesystemLoader('../HTML');
        // Utilisation de la variable dans la configuration de Twig
        $twig = new \Twig\Environment($loader, [
            'cache' => $twigCache,
        ]);
        // ajouter la var d'env $_SESSION en tant que var global pour l'environnement twig
        $twig->addGlobal('session', $_SESSION);
        echo $twig->render('main.twig', [
            'username' => $_SESSION['username']
        ]);
    } else {
        echo "Mot de passe incorrect : Connexion échouée";
    }
}
?>