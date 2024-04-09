<?php

session_start();

# Identifiants de connexion de l'utilisateur
$username = $_POST["username"];
$password = $_POST["password"];

# Identifiants de connexion à la BDD
$db_host = $_ENV['DB_HOST'];
$db_name   = $_ENV['DB_DB'];
$user = $_ENV['DB_USER'];
$psw = $_ENV['DB_PASSWORD'];

# Connexion en utilisant PDO
try {
    $dbcon = new PDO("pgsql:host=$db_host;dbname=$db_name", $user, $psw);
    echo "Connexion réussie \n";
    $queryusername = "SELECT username FROM \"users\" WHERE username = '$username' ";
    $querypsw = "SELECT password_hash FROM \"users\" WHERE username = '$username' ";
    var_dump($_SESSION);

} catch (PDOException $e) {
    echo "Erreur de connexion : \n" . $e->getMessage();
}


$Selectquery = "SELECT username FROM \"users\" WHERE username = $username";
$stmt = $dbcon->query($Selectquery);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>