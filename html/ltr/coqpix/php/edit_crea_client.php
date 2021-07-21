<?php

require_once 'config.php';    
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    $pdo = $bdd->prepare('UPDATE crea_societe SET email_crea=:email_crea, nom_diri=:nom_diri, prenom_diri=:prenom_diri, tel_diri=:tel_diri, status_crea=:status_crea, adresse_diri=:adresse_diri WHERE id=:num LIMIT 1');
    $pdo->bindValue(':num', $_POST['id']);
    $pdo->bindValue(':email_crea', $_POST['email_crea']);
    $pdo->bindValue(':nom_diri', $_POST['nom_diri']);
    $pdo->bindValue(':prenom_diri', $_POST['prenom_diri']);
    $pdo->bindValue(':tel_diri', $_POST['tel_diri']);
    $pdo->bindValue(':status_crea', $_POST['status_crea']);
    $pdo->bindValue(':adresse_diri', $_POST['adresse_diri']);
    
    $pdo->execute();
        
        header('Location: ../page-creation-edit.php?enregister=1');
        
    

?>
