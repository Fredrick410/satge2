<?php
session_start();
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    // vide

    if($_POST['numerosfacture'] == ""){
        $numerosfacture = "000d";
    }else{
        $numerosfacture = $_POST['numerosfacture'];
    }

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

    if($_POST['facturepour'] == ""){
        $facturepour = "Facture pour";
    }else{
        $facturepour = $_POST['facturepour'];
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

    if($_POST['statut'] == "NON PAYE"){
        $color = "badge badge-light-danger badge-pill";
    }else{
        $color = "badge badge-light-success badge-pill";
    }

    $insert = $bdd->prepare('INSERT INTO bon_commande (numerosbon, dte, dateecheance, nomproduit, bonpour, adresse, email, tel, departement, modalite, monnaie, note, status_bon, status_color, etiquette, id_session) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
    $insert->execute(array(
        htmlspecialchars($numerosfacture),
        htmlspecialchars($dte),
        htmlspecialchars($_POST['dateecheance']),
        htmlspecialchars($nomproduit),
        htmlspecialchars($facturepour),
        htmlspecialchars($adresse),
        htmlspecialchars($email),
        htmlspecialchars($tel),
        htmlspecialchars($departement),
        htmlspecialchars($_POST['modalite']),
        htmlspecialchars($_POST['monnaie']),
        htmlspecialchars($note),
        htmlspecialchars($_POST['statut']),
        htmlspecialchars($color),
        htmlspecialchars($_POST['etiquette']),
        htmlspecialchars($_SESSION['id_session']) //$_SESSION
    ));

        $pdoA = $bdd->prepare('UPDATE articles SET typ="bonachat" WHERE typ="" AND numeros=:numeros AND id_session=:num');  
        $pdoA->bindValue(':num', $_SESSION['id_session']); //$_SESSION
        $pdoA->bindValue(':numeros', $numerosfacture);
        $pdoA->execute();

        //delete tout les articles en plus
        
        $pdoDel = $bdd->prepare('DELETE FROM articles WHERE numeros= ""');
        $pdoDel->execute();

        

    header('Location: ../app-bon-achat-list.php');
    exit();


    
?>