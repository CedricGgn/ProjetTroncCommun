<?php
// Reprendre la session existante
session_start();

// Détruire toutes les données de session
session_unset();

// Détruisez complètement la session
session_destroy();

// Rediriger vers la page de connexion ou une autre page
header("Location: /PHP/login.php");
exit();
?>
