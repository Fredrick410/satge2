<?php

require_once 'config.php';    
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    if($_POST['new_user'] == "New"){
        $color = "badge badge-light-info badge-pill";
    }
    if($_POST['new_user'] == "Désactiver"){
        $color = "badge badge-light-warning badge-pill";
    }
    if($_POST['new_user'] == "Activé"){
        $color = "badge badge-light-success badge-pill";
    }
    if($_POST['new_user'] == "Bloqué"){
        $color = "badge badge-light-secondary badge-pill";
    }
    if($_POST['new_user'] == "Supprimé"){
        $color = "badge badge-light-danger badge-pill";
    }

    $pdo = $bdd->prepare('UPDATE entreprise SET nameentreprise=:nameentreprise, passwordentreprise=:passwordentreprise, nom_diri=:nom_diri, prenom_diri=:prenom_diri, emailentreprise=:emailentreprise, new_user=:new_user, color=:color WHERE id=:num LIMIT 1');
    $pdo->bindValue(':num', $_POST['id']);
    $pdo->bindValue(':nameentreprise', $_POST['nameentreprise']);
    $pdo->bindValue(':passwordentreprise', $_POST['passwordentreprise']);
    $pdo->bindValue(':nom_diri', $_POST['nom_diri']);
    $pdo->bindValue(':prenom_diri', $_POST['prenom_diri']);
    $pdo->bindValue(':emailentreprise', $_POST['emailentreprise']);
    $pdo->bindValue(':new_user', $_POST['new_user']);
    $pdo->bindValue(':color', $color);
    
    $pdo->execute();
        
        sleep(2);
        header('Location: ../utilisateurs.php');
        
    

?>
