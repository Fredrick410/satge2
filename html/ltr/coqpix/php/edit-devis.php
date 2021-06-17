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

    if($_POST['devispour'] == ""){
        $facturepour = "devis pour";
    }else{
        $facturepour = $_POST['devispour'];
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
    if($_POST['status_devis'] == "NON PAYE"){
        $color  = "badge badge-light-danger badge-pill";
    }else{
        $color = "badge badge-light-success badge-pill";
    }
    $pdo = $bdd->prepare('UPDATE devis SET numerosdevis=:numerosdevis, dte=:dte, refdevis=:refdevis, dateecheance=:dateecheance, nomproduit=:nomproduit, devispour=:devispour, adresse=:adresse, email=:email, tel=:tel, departement=:departement, modalite=:modalite, monnaie=:monnaie, accompte=:accompte, note=:note, status_devis=:status_devis, status_color=:status_color, etiquette=:etiquette, descrip=:descrip WHERE id=:num LIMIT 1');
    
    $pdo->bindValue(':num', $_POST['numdevis']);
    $pdo->bindValue(':numerosdevis', $_POST['numerosdevis']);
    $pdo->bindValue(':dte', $dte);
    $pdo->bindValue(':refdevis', $_POST['refdevis']);
    $pdo->bindValue(':dateecheance', $_POST['dateecheance']);
    $pdo->bindValue(':nomproduit', $nomproduit);
    $pdo->bindValue(':devispour', $facturepour);
    $pdo->bindValue(':adresse', $adresse);
    $pdo->bindValue(':email', $email);
    $pdo->bindValue(':tel', $tel);
    $pdo->bindValue(':departement', $departement);
    $pdo->bindValue(':modalite', $_POST['modalite']);
    $pdo->bindValue(':monnaie', $_POST['monnaie']);
    $pdo->bindValue(':accompte', $_POST['accompte']);
    $pdo->bindValue(':note', $note);
    $pdo->bindValue(':status_devis', $_POST['status_devis']);
    $pdo->bindValue(':status_color', $color);
    $pdo->bindValue(':etiquette', $_POST['etiquette']);
    $pdo->bindValue(':descrip', $_POST['descrip']);
    
    $pdo->execute();

        $pdoA = $bdd->prepare('UPDATE articles SET typ="devisvente" WHERE typ="" AND numeros=:numeros AND id_session=:num');  
        $pdoA->bindValue(':num', $_SESSION['id_session']); //$_SESSION
        $pdoA->bindValue(':numeros', $_POST['numdevis']);
        $pdoA->execute();

    //calculs

        $pdoS = $bdd->prepare('SELECT * FROM calculs WHERE id_session = :num');
        $pdoS->bindValue(':num',$_SESSION['id_session']); // $_SESSION
        $pdoS->execute();
        $calculs = $pdoS->fetch();

    try{
  
        $sql = "SELECT SUM(T.TOTAL) as MONTANT_T FROM ( SELECT cout,quantite ,(cout * quantite ) as TOTAL FROM articles WHERE id_session = :num AND numeros=:numeros AND typ='devisvente' ) T ";
        
        $req = $bdd->prepare($sql);
        $req->bindValue(':num',$_SESSION['id_session']); //$_SESSION
        $req->bindValue(':numeros',$_POST['numerosdevis']); 
        $req->execute();
        $res = $req->fetch();
        }catch(Exception $e){
            echo "Erreur " . $e->getMessage();
        }

        $montant_t = !empty($res) ? $res['MONTANT_T'] : 0;
        $res_montant = $calculs['devis_all']; //PAS OUBLIER DE CHANGER
        $edit = $montant_t - $res_montant;    

        $facture_nb = $calculs['facture_nb'];
        $facture_all = $calculs['facture_all'];
        $devis_all = $calculs['devis_all']  + $edit;
        $lastdte = $calculs['lastdte'];  // $calculs['lastdte'] pour autre de facture

        $pdo = $bdd->prepare('UPDATE calculs SET facture_nb=:facture_nb, facture_all=:facture_all, devis_all=:devis_all, lastdte=:lastdte WHERE id_session=:num LIMIT 1');
    
        $pdo->bindValue(':num', $_SESSION['id_session']); //$_SESSION
        $pdo->bindValue(':facture_nb', $facture_nb);
        $pdo->bindValue(':facture_all', $facture_all);
        $pdo->bindValue(':devis_all', $devis_all);
        $pdo->bindValue(':lastdte', $lastdte);
        $pdo->execute();

        sleep(2);
        header('Location: ../app-devis-list.php');
        
    

?>
