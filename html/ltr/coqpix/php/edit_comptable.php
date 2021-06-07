<?php

require_once 'config.php';    
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    $pdo = $bdd->prepare('UPDATE comptable SET nom=:nom, prenom=:prenom, email=:email, password_comptable=:password_comptable WHERE id=:num LIMIT 1');
    $pdo->bindValue(':num', $_POST['num']);
    $pdo->bindValue(':nom', $_POST['nom']);
    $pdo->bindValue(':prenom', $_POST['prenom']);
    $pdo->bindValue(':email', $_POST['email']);
    $pdo->bindValue(':password_comptable', $_POST['password']);
    
    $pdo->execute();
        
        sleep(2);
        header('Location: ../comptable.php');
        
    

?>
