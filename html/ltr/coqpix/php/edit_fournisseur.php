<?php

require_once 'config.php';    
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
session_start();

    $pdo = $bdd->prepare('UPDATE fournisseur SET  name_fournisseur=:name_fournisseur, nom=:nom, prenom=:prenom, adresse_diri=:adresse_diri, tel_diri=:tel_diri, email_diri=:email_diri, numsiret=:numsiret, tvaintracom=:tvaintracom, pays=:pays, adresse=:adresse, secteur=:secteur, tel=:tel, siteweb=:siteweb, email=:email, iban=:iban, id_session=:id_session WHERE id=:num LIMIT 1');
    $pdo->bindValue(':num', $_POST['id']);
    $pdo->bindValue(':name_fournisseur', $_POST['name_fournisseur']);
    $pdo->bindValue(':nom', $_POST['nom']);
    $pdo->bindValue(':prenom', $_POST['prenom']);
    $pdo->bindValue(':adresse_diri', $_POST['adresse_diri']);
    $pdo->bindValue(':tel_diri', $_POST['tel_diri']);
    $pdo->bindValue(':email_diri', $_POST['email_diri']);
    $pdo->bindValue(':numsiret', $_POST['numsiret']);
    $pdo->bindValue(':tvaintracom', $_POST['tvaintracom']);
    $pdo->bindValue(':pays', $_POST['pays']);
    $pdo->bindValue(':adresse', $_POST['adresse']);
    $pdo->bindValue(':secteur', $_POST['secteur']);
    $pdo->bindValue(':tel', $_POST['tel']);
    $pdo->bindValue(':siteweb', $_POST['siteweb']);
    $pdo->bindValue(':email', $_POST['email']);
    $pdo->bindValue(':iban', $_POST['iban']);
    $pdo->bindValue(':id_session', $_SESSION['id_session']);
    
    
    $pdo->execute();
        
        sleep(2);
        header('Location: ../fournisseur-list.php');
        
    

?>
