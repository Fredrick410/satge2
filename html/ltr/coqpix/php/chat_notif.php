<?php
session_start();
require_once 'config.php';    
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    $notif = !empty($_POST["notification_crea"]) ? json_decode($_POST["notification_crea"]) : NULL;

    $pdo = $bdd->prepare('UPDATE crea_societe SET notification_crea=:notification_crea WHERE id=:num LIMIT 1');
    $pdo->bindValue(':num', $_SESSION['id_crea']);
    $pdo->bindValue(':notification_crea', $notif);   
    $pdo->execute();

?>
