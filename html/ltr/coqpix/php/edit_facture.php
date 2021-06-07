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

    if($_POST['accompte'] == ""){
        $accompte = "Non définie";
    }else{
        $accompte = $_POST['modalite'];
    }

    // end vide 

    if($_POST['status_facture'] == "NON PAYE"){
        $color  = "badge badge-light-danger badge-pill";
    }else{
        $color = "badge badge-light-success badge-pill";
    }

    $pdo = $bdd->prepare('UPDATE facture SET dte=:dte, dateecheance=:dateecheance, nomproduit=:nomproduit, facturepour=:facturepour, adresse=:adresse, email=:email, tel=:tel, departement=:departement, modalite=:modalite, monnaie=:monnaie, accompte=:accompte, note=:note, status_facture=:status_facture, status_color=:status_color, etiquette=:etiquette WHERE id=:num LIMIT 1');
    
    $pdo->bindValue(':num', $_POST['numfacture']);
    $pdo->bindValue(':dte', $dte);
    $pdo->bindValue(':dateecheance', $_POST['dateecheance']);
    $pdo->bindValue(':nomproduit', $nomproduit);
    $pdo->bindValue(':facturepour', $facturepour);
    $pdo->bindValue(':adresse', $adresse);
    $pdo->bindValue(':email', $email);
    $pdo->bindValue(':tel', $tel);
    $pdo->bindValue(':departement', $departement);
    $pdo->bindValue(':modalite', $accompte);
    $pdo->bindValue(':monnaie', $_POST['monnaie']);
    $pdo->bindValue(':accompte', $_POST['accompte']);
    $pdo->bindValue(':note', $note);
    $pdo->bindValue(':status_facture', $_POST['status_facture']);
    $pdo->bindValue(':status_color', $color);
    $pdo->bindValue(':etiquette', $_POST['etiquette']);
    
    $pdo->execute();

        $pdoA = $bdd->prepare('UPDATE articles SET typ="facturevente" WHERE typ="" AND numeros=:numeros AND id_session=:num');  
        $pdoA->bindValue(':num', $_SESSION['id_session']); //$_SESSION
        $pdoA->bindValue(':numeros', $_POST['numerosfacture']);
        $pdoA->execute();

    //calculs

        $pdoS = $bdd->prepare('SELECT * FROM calculs WHERE id_session = :num');
        $pdoS->bindValue(':num',$_SESSION['id_session']); // $_SESSION
        $pdoS->execute();
        $calculs = $pdoS->fetch();

    try{
  
        $sql = "SELECT SUM(T.TOTAL) as MONTANT_T FROM ( SELECT cout,quantite ,(cout * quantite ) as TOTAL FROM articles WHERE id_session = :num AND numeros=:numeros AND typ='facturevente' ) T ";
        
        $req = $bdd->prepare($sql);
        $req->bindValue(':num',$_SESSION['id_session']); //$_SESSION
        $req->bindValue(':numeros',$_POST['numerosfacture']); 
        $req->execute();
        $res = $req->fetch();
        }catch(Exception $e){
            echo "Erreur " . $e->getMessage();
        }

        $montant_t = !empty($res) ? $res['MONTANT_T'] : 0;
        $res_montant = $calculs['facture_all']; //PAS OUBLIER DE CHANGER
        $edit = $montant_t - $res_montant;    

        $facture_nb = $calculs['facture_nb'];
        $facture_all = $calculs['facture_all'] + $edit;
        $devis_all = $calculs['devis_all'];
        $lastdte = date('d-m-Y');  // $calculs['lastdte'] pour autre de facture

        $pdo = $bdd->prepare('UPDATE calculs SET facture_nb=:facture_nb, facture_all=:facture_all, devis_all=:devis_all, lastdte=:lastdte WHERE id_session=:num LIMIT 1');
    
        $pdo->bindValue(':num', $_SESSION['id_session']); //$_SESSION
        $pdo->bindValue(':facture_nb', $facture_nb);
        $pdo->bindValue(':facture_all', $facture_all);
        $pdo->bindValue(':devis_all', $devis_all);
        $pdo->bindValue(':lastdte', $lastdte);
        $pdo->execute();

        sleep(2);
        header('Location: ../app-invoice-list.php');
        
    

?>
