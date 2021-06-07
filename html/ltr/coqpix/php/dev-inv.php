<?php
session_start();
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    //recuperation des données

    $pdoStat = $bdd->prepare('SELECT * FROM devis WHERE id = :id AND id_session=:id_session');
    $pdoStat->bindValue(':id',$_GET['id']);
    $pdoStat->bindValue(':id_session',$_SESSION['id_session']); //$_SESSION 
    $pdoStat->execute();
    $info = $pdoStat->fetch();

      // Auto incrementation 

      $pdoStati = $bdd->prepare('SELECT numerosfacture FROM facture WHERE id_session=:id_session');
      $pdoStati->bindValue(':id_session',$_SESSION['id_session']); //$_SESSION 
      $pdoStati->execute();
      $facturenum = $pdoStati->fetchAll();

      foreach($facturenum as $facturenumm):
        $max = $facturenumm['numerosfacture'];	
      endforeach;

      $newnumber = $max + 1;

      if(strlen($newnumber) == "1"){
          $finalenumber = '00'.$newnumber.'';
      }

      if(strlen($newnumber) == "2"){
          $finalenumber = '0'.$newnumber.'';
      }

      // Auto incrementation
      $numerosinfo = $finalenumber;
      $dte = $info['dte']; //changer 
      $dateecheance = $info['dateecheance'];
      $nomproduit = $info['nomproduit'];
      $pour = $info['devispour']; //changer
      $adresse = $info['adresse'];
      $email = $info['email'];
      $tel = $info['tel'];
      $departement = $info['departement'];
      $modalite = $info['modalite'];
      $monnaie = $info['monnaie'];
      $accompte = "0";
      $note = $info['note'];
      $status = $info['status_devis']; //changer
      $color = $info['status_color'];
      $etiquette = $info['etiquette'];

    //insert

    $insert = $bdd->prepare('INSERT INTO facture (numerosfacture, dte, dateecheance, nomproduit, facturepour, adresse, email, tel, departement, modalite, monnaie, accompte, note, status_facture, status_color, etiquette, id_session) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
    $insert->execute(array(
        htmlspecialchars($numerosinfo),
        htmlspecialchars($dte),
        htmlspecialchars($dateecheance),
        htmlspecialchars($nomproduit),
        htmlspecialchars($pour),
        htmlspecialchars($adresse),
        htmlspecialchars($email),
        htmlspecialchars($tel),
        htmlspecialchars($departement),
        htmlspecialchars($modalite),
        htmlspecialchars($monnaie),
        htmlspecialchars($accompte),
        htmlspecialchars($note),
        htmlspecialchars($status),
        htmlspecialchars($color),
        htmlspecialchars($etiquette),
        htmlspecialchars($_SESSION['id_session']) //$_SESSION
    ));

        //calculs

        $pdoS = $bdd->prepare('SELECT * FROM calculs WHERE id_session = :num');
        $pdoS->bindValue(':num',$_SESSION['id_session']); // $_SESSION
        $pdoS->execute();
        $calculs = $pdoS->fetch();

    try{
  
        $sql = "SELECT SUM(T.TOTAL) as MONTANT_T FROM ( SELECT cout,quantite ,(cout * quantite ) as TOTAL FROM articles WHERE id_session = :num AND numeros=:numeros AND typ='devisvente' ) T ";
        
        $req = $bdd->prepare($sql);
        $req->bindValue(':num',$_SESSION['id_session']); //$_SESSION
        $req->bindValue(':numeros',$numerosinfo); 
        $req->execute();
        $res = $req->fetch();
    }catch(Exception $e){
        echo "Erreur " . $e->getMessage();
    }

        $montant_t = !empty($res) ? $res['MONTANT_T'] : 0;       

        $facture_nb = $calculs['facture_nb'] + 1;
        $facture_all = $calculs['facture_all'] + $montant_t;
        $devis_all = $calculs['devis_all'] - $montant_t;
        $lastdte = date('d-m-Y');  // $calculs['lastdte'] pour autre de facture

        $pdo = $bdd->prepare('UPDATE calculs SET facture_nb=:facture_nb, facture_all=:facture_all, devis_all=:devis_all, lastdte=:lastdte WHERE id_session=:num LIMIT 1');
    
        $pdo->bindValue(':num', $_SESSION['id_session']); //$_SESSION
        $pdo->bindValue(':facture_nb', $facture_nb);
        $pdo->bindValue(':facture_all', $facture_all);
        $pdo->bindValue(':devis_all', $devis_all);
        $pdo->bindValue(':lastdte', $lastdte);
        $pdo->execute();

        //switch article de devis a facture

        $pdoA = $bdd->prepare('UPDATE articles SET typ="facturevente", numeros=:newnum WHERE typ="devisvente" AND numeros=:numeros AND id_session=:num');  
        $pdoA->bindValue(':num', $_SESSION['id_session']); //$_SESSION
        $pdoA->bindValue(':numeros', $info['numerosdevis']);
        $pdoA->bindValue(':newnum', $numerosinfo);
        $pdoA->execute();
        
        //delete devis

        $pdoDel = $bdd->prepare('DELETE FROM devis WHERE id=:id LIMIT 1');
        $pdoDel->bindValue(':id', $_GET['id']);
        $pdoDel->execute();
        
        
        header('Location: ../app-invoice-list.php');
        exit();

?>
