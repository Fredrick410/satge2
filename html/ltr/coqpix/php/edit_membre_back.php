<?php

require_once 'config.php';    
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    $pdo = $bdd->prepare('UPDATE entreprise SET nameentreprise=:nameentreprise, , nom_diri=:nom_diri, prenom_diri=:prenom_diri, emailentreprise=:emailentreprise WHERE id=:num LIMIT 1');
    $pdo->bindValue(':num', $_POST['id']);
    $pdo->bindValue(':nameentreprise', $_POST['nameentreprise']);
    $pdo->bindValue(':nom_diri', $_POST['nom_diri']);
    $pdo->bindValue(':prenom_diri', $_POST['prenom_diri']);
    $pdo->bindValue(':emailentreprise', $_POST['emailentreprise']);
    
    $pdo->execute();
        
        sleep(2);
        header('Location: ../utilisateurs.php');
        
    

?>
