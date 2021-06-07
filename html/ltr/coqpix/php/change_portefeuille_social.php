<?php
session_start();
require_once 'config.php';    
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    if($_GET['type'] == "actif"){

        $pdo = $bdd->prepare('UPDATE portefeuille_social SET statut=:statut WHERE id=:num LIMIT 1');
        $pdo->bindValue(':num', $_GET['num']);
        $pdo->bindValue(':statut', "actif");   
        $pdo->execute();

        header('Location: ../portefeuille-social.php');
        exit();
    }

    if($_GET['type'] == "passif"){

        $pdo = $bdd->prepare('UPDATE portefeuille_social SET statut=:statut WHERE id=:num LIMIT 1');
        $pdo->bindValue(':num', $_GET['num']);
        $pdo->bindValue(':statut', "passif");   
        $pdo->execute();

        header('Location: ../portefeuille-social.php');
        exit();

    }

?>
