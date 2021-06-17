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
    
    $max_num = "";
    $pdoSt = $bdd->prepare('SELECT id FROM facture');
            $pdoSt->bindValue(':num',$_SESSION['id_session']); //$_SESSION
            $pdoSt->execute(); 
            $num = $pdoSt->fetchAll();
            $count_num = count($num);
            $max_num = "0";
            for ($i=0; $i < $count_num ; $i++) { 
                foreach($num as $n):

                    $number = $n['id'];
                    if($number > $max_num){
                        $max_num = $number;
                    }

                endforeach;
            }

            $max_num = $max_num + 1;

            $strlen_num = strlen($max_num);
            
            if($strlen_num == "1"){
                $max_num = '0'.$max_num;
            }elseif($strlen_num == "2"){
                $max_num = '0'.$max_num;
            }elseif($strlen_num >= "3"){
                $max_num = $max_num;
            }

           
    
      $idfac = $info['id'];
      $numerosinfo = $info['numerosdevis'];   // numeros facture ou devis ect
      $dte = $info['dte']; //changer 
      $dateecheance = $info['dateecheance'];
      $ref = $info['refdevis'];
      $nomproduit = $info['nomproduit'];
      $pour = $info['devispour']; //changer
      $adresse = $info['adresse'];
      $email = $info['email'];
      $tel = $info['tel'];
      $departement = $info['departement'];
      $modalite = $info['modalite'];
      $monnaie = $info['monnaie'];
      $note = $info['note'];
      $accompte = $info['accompte'];
      $status = $info['status_devis']; //changer
      $color = "badge badge-light-danger badge-pill";
      $descrip = $info['descrip'];
      $etiquette = $info['etiquette'];
      
    //insert

    $insert = $bdd->prepare('INSERT INTO facture (numerosfacture, dte, dateecheance, reffacture, nomproduit, facturepour, adresse, email, tel, departement, modalite, monnaie, note, accompte, status_facture, status_color, etiquette, descrip, id_session) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
    $insert->execute(array(
        htmlspecialchars($numerosinfo),
        htmlspecialchars($dte),
        htmlspecialchars($dateecheance),
        htmlspecialchars($ref),
        htmlspecialchars($nomproduit),
        htmlspecialchars($pour),
        htmlspecialchars($adresse),
        htmlspecialchars($email),
        htmlspecialchars($tel),
        htmlspecialchars($departement),
        htmlspecialchars($modalite),
        htmlspecialchars($monnaie),
        htmlspecialchars($note),
        htmlspecialchars($accompte),
        htmlspecialchars($status),
        htmlspecialchars($color),
        htmlspecialchars($etiquette),
        htmlspecialchars($descrip),
        htmlspecialchars($_SESSION['id_session']) //$_SESSION
    ));
        $pdod = $bdd->prepare('UPDATE devis SET monnaie="Devis Envoyée" WHERE monnaie="€" AND id=:numeros AND id_session=:num');  
        $pdod->bindValue(':num', $_SESSION['id_session']); //$_SESSION
        $pdod->bindValue(':numeros',  $idfac);
        $pdod->execute();
        //calculs

        $pdoS = $bdd->prepare('SELECT * FROM calculs WHERE id_session = :num');
        $pdoS->bindValue(':num',$_SESSION['id_session']); // $_SESSION
        $pdoS->execute();
        $calculs = $pdoS->fetch();

    try{
  
        $sql = "SELECT SUM(T.TOTAL) as MONTANT_T FROM ( SELECT cout,quantite ,(cout * quantite ) as TOTAL FROM articles WHERE id_session = :num AND numeros=:numeros AND typ='facturevente' ) T ";
        
        $req = $bdd->prepare($sql);
        $req->bindValue(':num',$_SESSION['id_session']); //$_SESSION
        $req->bindValue(':numeros', $idfac); 
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
        
        

        $pdoA = $bdd->prepare('UPDATE articles SET typ="facturevente" WHERE typ="devisvente" AND numeros=:numeros AND id_session=:num');  
        $pdoA->bindValue(':num', $_SESSION['id_session']); //$_SESSION
        $pdoA->bindValue(':numeros',  $idfac);
        $pdoA->execute();
        
        $pdoc = $bdd->prepare('UPDATE articles SET numeros=:numeros WHERE typ="facturevente" AND numeros=:fac AND id_session=:num');  
        $pdoc->bindValue(':num', $_SESSION['id_session']); //$_SESSION
        $pdoc->bindValue(':numeros',  $max_num);
        $pdoc->bindValue(':fac',  $idfac);
        $pdoc->execute();
        
        //delete devis

       
        
        
        header('Location: ../app-invoice-list.php');
        exit();

?>
