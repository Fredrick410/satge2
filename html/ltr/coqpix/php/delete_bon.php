<?php
    
session_start();
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

        //delete des articles pas définie

        $pdoDel = $bdd->prepare('DELETE FROM articles WHERE numeros= ""');
        $pdoDel->execute();

        $pdoae = $bdd->prepare('SELECT * FROM bon WHERE id=:id AND id_session = :num');
        $pdoae->bindValue(':id', $_GET['id']);
        $pdoae->bindValue(':num',$_SESSION['id_session']); // $_SESSION
        $pdoae->execute();
        $bon = $pdoae->fetch();

        $incre = $bdd->prepare('SELECT MAX(id) FROM bon ');
        $incre->execute();
        $test = $incre->fetch();
        $maxid = $test['MAX(id)'] ;

        //calculs

        $pdoS = $bdd->prepare('SELECT * FROM calculs WHERE id_session = :num');
        $pdoS->bindValue(':num',$_SESSION['id_session']); // $_SESSION
        $pdoS->execute();
        $calculs = $pdoS->fetch();

        try{
  
        $sql = "SELECT SUM(T.TOTAL) as MONTANT_T FROM ( SELECT cout,quantite ,(cout * quantite ) as TOTAL FROM articles WHERE id_session = :num AND numeros=:numeros AND typ='bonvente' ) T ";
        
        $req = $bdd->prepare($sql);
        $req->bindValue(':num',$_SESSION['id_session']); //$_SESSION
        $req->bindValue(':numeros',$_GET['numbon']); 
        $req->execute();
        $res = $req->fetch();
        }catch(Exception $e){
            echo "Erreur " . $e->getMessage();
        }

        $montant_t = !empty($res) ? $res['MONTANT_T'] : 0;       

        $facture_nb = $calculs['facture_nb'] - 1;
        $facture_all = $calculs['facture_all'] - $montant_t;
        $devis_all = $calculs['facture_all'];
        $lastdte = date('d-m-Y');  // $calculs['lastdte'] pour autre de facture

        $pdo = $bdd->prepare('UPDATE calculs SET facture_nb=:facture_nb, facture_all=:facture_all, devis_all=:devis_all, lastdte=:lastdte WHERE id_session=:num LIMIT 1');
    
        $pdo->bindValue(':num', $_SESSION['id_session']); //$_SESSION
        $pdo->bindValue(':facture_nb', $facture_nb);
        $pdo->bindValue(':facture_all', $facture_all);
        $pdo->bindValue(':devis_all', $devis_all);
        $pdo->bindValue(':lastdte', $lastdte);
        $pdo->execute();

        
        if( $_GET['id'] == $maxid){ 
            $vide="Veuillez créer un autre bon </br> pour pouvoir supprimer celui-ci";
            $rien="";
            $pdoez = $bdd->prepare('UPDATE bon SET numerosbon=:numerosbon, dte=:dte, refbon=:refbon, bonpour=:bonpour, monnaie=:monnaie, status_bon=:status_bon, etiquette=:etiquette WHERE id=:id AND id_session=:id_session');
            $pdoez->bindValue(':id', $_GET['id']);
            $pdoez->bindValue(':numerosbon', $rien);
            $pdoez->bindValue(':dte', $rien);
            $pdoez->bindValue(':refbon', $vide);
            $pdoez->bindValue(':bonpour', $rien);
            $pdoez->bindValue(':monnaie', $rien);
            $pdoez->bindValue(':status_bon', $rien);
            $pdoez->bindValue(':etiquette', $rien);
            $pdoez->bindValue(':id_session',$_SESSION['id_session']); //$_SESSION
            $pdoez->execute();

            $pdoDel = $bdd->prepare('DELETE FROM articles WHERE numeros=:num AND id_session =:id_session AND typ="bonvente"'); //pour supprimer la valeur
        $pdoDel->bindValue(':num', $_GET['numbon']);
        $pdoDel->bindValue(':id_session', $_SESSION['id_session']); //$_SESSION
        $pdoDel->execute();
        }else {
            $pdoDel = $bdd->prepare('DELETE FROM articles WHERE numeros=:num AND id_session =:id_session AND typ="bonvente"');
        $pdoDel->bindValue(':num', $_GET['numbon']);
        $pdoDel->bindValue(':id_session', $_SESSION['id_session']); //$_SESSION
        $pdoDel->execute();

        $pdoDe = $bdd->prepare('DELETE FROM bon WHERE id=:id AND id_session=:id_session');
        $pdoDe->bindValue(':id', $_GET['id']);
        $pdoDe->bindValue(':id_session',$_SESSION['id_session']); //$_SESSION
        $pdoDe->execute();
        }
        

        //end calculs

        

        sleep(1);
        header('Location: ../app-bon-list.php');
        exit();
    
?>