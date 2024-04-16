<?php

try {
        $host = $_ENV['DB_HOST'];
        $db   = $_ENV['DB_DB'];
        $user = $_ENV['DB_USER'];
        $pass = $_ENV['DB_PASSWORD'];

        $dsn = "pgsql:host=$host;port=5432;dbname=$db";


        $dbh = new PDO($dsn, $user, $pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        echo("Connection réussie !!");
 
} catch (PDOException $e) {
    echo "Échec de la connexion à la base de données : " . $e->getMessage();
}


?>