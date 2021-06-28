<?php

require_once 'config.php';    
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    $pdo = $bdd->prepare('UPDATE entreprise SET new_user=:new_user, color=:color WHERE id=:num LIMIT 1');
    $pdo->bindValue(':num', $_GET['id']);
    $pdo->bindValue(':new_user', $_GET['new_user']);
    $pdo->bindValue(':color', "badge badge-light-secondary badge-pill");
    
    $pdo->execute();
        
        sleep(2);
        header('Location: ../utilisateurs.php');
        
?>
