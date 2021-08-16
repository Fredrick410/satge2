<?php

require_once 'config.php';    
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    $pdo = $bdd->prepare('UPDATE crea_societe SET status_crea=:status_crea, secteur_dactivite=:secteur_dactivite, adresse_entreprise=:adresse_entreprise, ville_entreprise=:ville_entreprise, cp_entreprise=:cp_entreprise WHERE id=:num LIMIT 1');
    $pdo->bindValue(':num', $_POST['id']);
    $pdo->bindValue(':status_crea', $_POST['status_crea']);
    $pdo->bindValue(':secteur_dactivite', $_POST['secteur_dactivite']);
    $pdo->bindValue(':adresse_entreprise', $_POST['adresse_entreprise']);
    $pdo->bindValue(':ville_entreprise', $_POST['ville_entreprise']);
    $pdo->bindValue(':cp_entreprise', $_POST['cp_entreprise']);
    
    $pdo->execute();
        
        header('Location: ../page-creation-edit.php?enregister=1');
        
    

?>