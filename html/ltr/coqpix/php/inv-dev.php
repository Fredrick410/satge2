<?php
session_start();
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    //recuperation des données

    $pdoStat = $bdd->prepare('SELECT * FROM facture WHERE id = :id AND id_session=:id_session');
    $pdoStat->bindValue(':id',$_GET['id']);
    $pdoStat->bindValue(':id_session',$_SESSION['id_session']); //$_SESSION 
    $pdoStat->execute();
    $info = $pdoStat->fetch();

      $numerosinfo = $info['numerosfacture'];   // numeros facture ou devis ect
      $dte = $info['dte']; //changer 
      $dateecheance = $info['dateecheance'];
      $nomproduit = $info['nomproduit'];
      $pour = $info['facturepour']; //changer
      $adresse = $info['adresse'];
      $email = $info['email'];
      $tel = $info['tel'];
      $departement = $info['departement'];
      $modalite = $info['modalite'];
      $monnaie = $info['monnaie'];
      $note = $info['note'];
      $status = $info['status_facture']; //changer
      $color = "badge badge-light-danger badge-pill";
      $etiquette = $info['etiquette'];

    //insert

    $insert = $bdd->prepare('INSERT INTO devis (numerosdevis, dte, dateecheance, nomproduit, devispour, adresse, email, tel, departement, modalite, monnaie, note, status_devis, status_color, etiquette, id_session) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
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
  
        $sql = "SELECT SUM(T.TOTAL) as MONTANT_T FROM ( SELECT cout,quantite ,(cout * quantite ) as TOTAL FROM articles WHERE id_session = :num AND numeros=:numeros AND typ='facturevente' ) T ";
        
        $req = $bdd->prepare($sql);
        $req->bindValue(':num',$_SESSION['id_session']); //$_SESSION
        $req->bindValue(':numeros',$numerosinfo); 
        $req->execute();
        $res = $req->fetch();
    }catch(Exception $e){
        echo "Erreur " . $e->getMessage();
    }

        $montant_t = !empty($res) ? $res['MONTANT_T'] : 0;       

        $facture_nb = $calculs['facture_nb'] - 1;
        $facture_all = $calculs['facture_all'] - $montant_t;
        $devis_all = $calculs['devis_all'] + $montant_t;
        $lastdte = date('d-m-Y');  // $calculs['lastdte'] pour autre de facture

        $pdo = $bdd->prepare('UPDATE calculs SET facture_nb=:facture_nb, facture_all=:facture_all, devis_all=:devis_all, lastdte=:lastdte WHERE id_session=:num LIMIT 1');
    
        $pdo->bindValue(':num', $_SESSION['id_session']); //$_SESSION
        $pdo->bindValue(':facture_nb', $facture_nb);
        $pdo->bindValue(':facture_all', $facture_all);
        $pdo->bindValue(':devis_all', $devis_all);
        $pdo->bindValue(':lastdte', $lastdte);
        $pdo->execute();

        //switch article de devis a facture

        $pdoA = $bdd->prepare('UPDATE articles SET typ="devisvente" WHERE typ="facturevente" AND numeros=:numeros AND id_session=:num');  
        $pdoA->bindValue(':num', $_SESSION['id_session']); //$_SESSION
        $pdoA->bindValue(':numeros', $numerosinfo);
        $pdoA->execute();
        
        //delete devis

        $pdoDel = $bdd->prepare('DELETE FROM facture WHERE id=:id LIMIT 1');
        $pdoDel->bindValue(':id', $_GET['id']);
        $pdoDel->execute();
        
        
        header('Location: ../app-devis-list.php');
        exit();

?>
