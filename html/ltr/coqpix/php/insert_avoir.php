<?php
session_start();
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    $pdoS = $bdd->prepare('SELECT * FROM facture WHERE id_session = :num AND id = :numfacture');
    $pdoS->bindValue(':num',$_SESSION['id_session']); // $_SESSION
    $pdoS->bindValue(':numfacture',$_POST['numfacture']);
    $pdoS->execute();
    $facture = $pdoS->fetch();

    $numerosavoir = $_POST['numerosavoir'];
    $dte = $facture['dte'];
    $dateecheance = $facture['dateecheance'];
    $nomproduit = $facture['nomproduit'];
    $avoirpour = $facture['facturepour'];
    $adresse = $facture['adresse'];
    $email = $facture['email'];
    $tel = $facture['tel'];
    $departement = $facture['departement'];
    $modalite = $facture['modalite'];
    $monnaie = $facture['monnaie'];
    $note = $facture['note'];
    $status_avoir = $facture['status_facture'];
    $status_color = $facture['status_color'];
    $etiquette = $facture['etiquette'];
    $numerosfacture = $_POST['numfacture'];

    $insert = $bdd->prepare('INSERT INTO avoir (numerosavoir, dte, dateecheance, nomproduit, avoirpour, adresse, email, tel, departement, modalite, monnaie, note, status_avoir, status_color, etiquette, numerosfacture, id_session) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
    $insert->execute(array(
        htmlspecialchars($numerosavoir),
        htmlspecialchars($dte),
        htmlspecialchars($dateecheance),
        htmlspecialchars($nomproduit),
        htmlspecialchars($avoirpour),
        htmlspecialchars($adresse),
        htmlspecialchars($email),
        htmlspecialchars($tel),
        htmlspecialchars($departement),
        htmlspecialchars($modalite),
        htmlspecialchars($monnaie),
        htmlspecialchars($note),
        htmlspecialchars($status_avoir),
        htmlspecialchars($status_color),
        htmlspecialchars($etiquette),
        htmlspecialchars($numerosfacture),
        htmlspecialchars($_SESSION['id_session']) //$_SESSION
    ));

        $pdoA = $bdd->prepare('UPDATE articles SET typ="avoirvente" WHERE typ="" AND numeros=:numeros AND id_session=:num');  
        $pdoA->bindValue(':num', $_SESSION['id_session']); //$_SESSION
        $pdoA->bindValue(':numeros', $numerosavoir);
        $pdoA->execute();

        //delete tout les articles en plus
        
        $pdoDel = $bdd->prepare('DELETE FROM articles WHERE numeros= ""');
        $pdoDel->execute();
        

    header('Location: ../app-avoir-list.php');
    exit();
    
?>