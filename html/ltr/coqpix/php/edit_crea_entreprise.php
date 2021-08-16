<?php

require_once 'config.php';    
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    $pdo = $bdd->prepare('UPDATE crea_societe SET status_crea=:status_crea, secteur_dactivite=:secteur_dactivite, adresse_entreprise=:adresse_entreprise WHERE id=:num LIMIT 1');
    $pdo->bindValue(':num', $_POST['id']);
    $pdo->bindValue(':status_crea', $_POST['status_crea']);
    $pdo->bindValue(':secteur_dactivite', $_POST['secteur_dactivite']);
    $pdo->bindValue(':adresse_entreprise', $_POST['adresse_entreprise']);
    
    $pdo->execute();
        
        header('Location: ../page-creation-edit.php?enregister=1');
        
    

?>