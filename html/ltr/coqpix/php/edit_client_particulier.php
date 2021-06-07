<?php

require_once 'config.php';    
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);


    $pdo = $bdd->prepare('UPDATE client SET  name_client=:name_client, prenom=:prenom, iban=:iban, secteur=:secteur, tel=:tel, email=:email, siteweb=:siteweb, adresse=:adresse, pays=:pays WHERE id=:num LIMIT 1');
    $pdo->bindValue(':num', $_POST['id']);
    $pdo->bindValue(':name_client', $_POST['name_client']);
    $pdo->bindValue(':prenom', $_POST['prenom']);
    $pdo->bindValue(':iban', $_POST['iban']);
    $pdo->bindValue(':secteur', $_POST['secteur']);
    $pdo->bindValue(':tel', $_POST['tel']);
    $pdo->bindValue(':email', $_POST['email']);
    $pdo->bindValue(':siteweb', $_POST['siteweb']);
    $pdo->bindValue(':adresse', $_POST['adresse']);
    $pdo->bindValue(':pays', $_POST['pays']);
    
    $pdo->execute();
        
        sleep(2);
        header('Location: ../client.php');
        
    

?>
