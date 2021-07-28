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

    if($_POST['nom_bon'] == ""){
        $nom_bon = "nom produit";
    }else{
        $nom_bon = $_POST['nom_bon'];
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

    $pdo = $bdd->prepare('UPDATE bon_commande SET dte=:dte, dateecheance=:dateecheance, nom_bon=:nom_bon, refbon=:refbon, modalite=:modalite, monnaie=:monnaie, note=:note, status_bon=:status_bon, status_color=:status_color, etiquette=:etiquette, descrip=:descrip, numerosfournisseur=:numerosfournisseur WHERE id_bon_commande=:num LIMIT 1');
    
    $pdo->bindValue(':num', $_POST['numbon']);
    $pdo->bindValue(':dte', $dte);
    $pdo->bindValue(':dateecheance', $_POST['dateecheance']);
    $pdo->bindValue(':nom_bon', $nom_bon);
    $pdo->bindValue(':refbon', $_POST['refbon']);
    $pdo->bindValue(':modalite', $_POST['modalite']);
    $pdo->bindValue(':monnaie', $_POST['monnaie']);
    $pdo->bindValue(':note', $note);
    $pdo->bindValue(':status_bon', $_POST['status_bon']);
    $pdo->bindValue(':status_color', $color);
    $pdo->bindValue(':etiquette', $_POST['etiquette']);
    $pdo->bindValue(':descrip', $_POST['descrip']);
    $pdo->bindValue(':numerosfournisseur', $_POST['numerosfournisseur']);
    
    $pdo->execute();

        $pdoA = $bdd->prepare('UPDATE articles SET typ="bonachat" WHERE typ="" AND numeros=:numeros AND id_session=:num');  
        $pdoA->bindValue(':num', $_SESSION['id_session']); //$_SESSION
        $pdoA->bindValue(':numeros', $_POST['numbon']);
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
            $req->bindValue(':numeros',$_GET['numfacture']); 
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
        header('Location: ../inventaire-commande-fourni.php');
        
    

?>
