<?php
require_once '../vendor/autoload.php';

try {
    $host = $_ENV['DB_HOST'];
    $db   = $_ENV['DB_DB'];
    $user = $_ENV['DB_USER'];
    $pass = $_ENV['DB_PASSWORD'];
    $dsn = "pgsql:host=$host;port=5432;dbname=$db";
    $dbh = new PDO($dsn, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo("Connexion réussie !");
 
} catch (PDOException $e) {
    echo "Échec de la connexion à la base de données : " . $e->getMessage();
}

 // Lire la variable d'environnement
 $isProduction = ($_SERVER['APP_ENV'] ?? '') === 'production';

 // Utilisation de la variable pour définir le cache dans Twig
 //$twigCache = $isProduction ? '../cache' : false;
 $loader = new \Twig\Loader\FilesystemLoader('../HTML');
 // Utilisation de la variable dans la configuration de Twig
 $twig = new \Twig\Environment($loader, [
    'cache' => '../cache',
 ]);

 

?>