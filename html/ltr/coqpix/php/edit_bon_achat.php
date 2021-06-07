<?php
session_start();
require_once 'config.php';    
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    // vide

    if($_POST['dte'] == ""){
        $dte = "00-00-00";
    }else{
        $dte = $_POST['dte'];
    }

    if($_POST['nomproduit'] == ""){
        $nomproduit = "nom produit";
    }else{
        $nomproduit = $_POST['nomproduit'];
    }

    if($_POST['bonpour'] == ""){
        $facturepour = "Bon pour";
    }else{
        $facturepour = $_POST['bonpour'];
    }

    if($_POST['adresse'] == ""){
        $adresse = "Adresse";
    }else{
        $adresse = $_POST['adresse'];
    }

    if($_POST['departement'] == ""){
        $departement = "31100";
    }else{
        $departement = $_POST['departement'];
    }

    if($_POST['email'] == ""){
        $email = "email@email.com";
    }else{
        $email = $_POST['email'];
    }

    if($_POST['tel'] == ""){
        $tel = "06.00.00.00.00";
    }else{
        $tel = $_POST['tel'];
    }

    if($_POST['note'] == ""){
        $note = "Pas de commentaire";
    }else{
        $note = $_POST['note'];
    }

    // end vide 

    if($_POST['status_bon'] == "NON PAYE"){
        $color  = "badge badge-light-danger badge-pill";
    }else{
        $color = "badge badge-light-success badge-pill";
    }

    $pdo = $bdd->prepare('UPDATE bon_commande SET dte=:dte, dateecheance=:dateecheance, nomproduit=:nomproduit, bonpour=:bonpour, adresse=:adresse, email=:email, tel=:tel, departement=:departement, modalite=:modalite, monnaie=:monnaie, note=:note, status_bon=:status_bon, status_color=:status_color, etiquette=:etiquette WHERE id=:num LIMIT 1');
    
    $pdo->bindValue(':num', $_POST['numbon']);
    $pdo->bindValue(':dte', $dte);
    $pdo->bindValue(':dateecheance', $_POST['dateecheance']);
    $pdo->bindValue(':nomproduit', $nomproduit);
    $pdo->bindValue(':bonpour', $facturepour);
    $pdo->bindValue(':adresse', $adresse);
    $pdo->bindValue(':email', $email);
    $pdo->bindValue(':tel', $tel);
    $pdo->bindValue(':departement', $departement);
    $pdo->bindValue(':modalite', $_POST['modalite']);
    $pdo->bindValue(':monnaie', $_POST['monnaie']);
    $pdo->bindValue(':note', $note);
    $pdo->bindValue(':status_bon', $_POST['status_bon']);
    $pdo->bindValue(':status_color', $color);
    $pdo->bindValue(':etiquette', $_POST['etiquette']);
    
    $pdo->execute();

        $pdoA = $bdd->prepare('UPDATE articles SET typ="bonachat" WHERE typ="" AND numeros=:numeros AND id_session=:num');  
        $pdoA->bindValue(':num', $_SESSION['id_session']); //$_SESSION
        $pdoA->bindValue(':numeros', $_POST['numerosbon']);
        $pdoA->execute();

        sleep(2);
        header('Location: ../app-bon-achat-list.php');
        
    

?>
