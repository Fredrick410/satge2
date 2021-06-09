<?php
session_start();
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    // vide

    if($_POST['numerosdevis'] == ""){
        $numerosfacture = "000d";
    }else{
        $numerosfacture = $_POST['numerosdevis'];
    }
    $numeroarticle = $_POST['numeroarticle'];
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
        $accompte = "O";
    }else{
        $accompte = $_POST['accompte'];
    }

    // end vide 
   if($_POST['statut'] == "NON PAYE"){
        $color = "badge badge-light-danger badge-pill";
    }else{
        $color = "badge badge-light-success badge-pill";
    }

    $insert = $bdd->prepare('INSERT INTO devis (numerosdevis, dte, dateecheance, nomproduit, refdevis, devispour, adresse, email, tel, departement, modalite, monnaie, accompte, note, status_devis, status_color, etiquette, id_session, descrip) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
    $insert->execute(array(
        htmlspecialchars($_POST['numerosdevis']),
        htmlspecialchars($dte),
        htmlspecialchars($_POST['dateecheance']),
        htmlspecialchars($nomproduit),
        htmlspecialchars($_POST['refdevis']),
        htmlspecialchars($_POST['devispour']),
        htmlspecialchars($adresse),
        htmlspecialchars($email),
        htmlspecialchars($tel),
        htmlspecialchars($departement),
        htmlspecialchars($_POST['modalite']),
        htmlspecialchars($_POST['monnaie']),
        htmlspecialchars($accompte),
        htmlspecialchars($note),
        htmlspecialchars($_POST['statut']),
        htmlspecialchars($color),
        htmlspecialchars($_POST['etiquette']),
        htmlspecialchars($_SESSION['id_session']),//$_SESSION
        htmlspecialchars($_POST['descrip']) 
    ));

        $pdoA = $bdd->prepare('UPDATE articles SET typ="devisvente" WHERE typ="" AND numeros=:numeros AND id_session=:num');  
        $pdoA->bindValue(':num', $_SESSION['id_session']); //$_SESSION
        $pdoA->bindValue(':numeros', $numeroarticle);
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
        $req->bindValue(':numeros',$_POST['numeroarticle']); 
        $req->execute();
        $res = $req->fetch();
        }catch(Exception $e){
            echo "Erreur " . $e->getMessage();
        }

        $montant_t = !empty($res) ? $res['MONTANT_T'] : 0;       

        $facture_nb = $calculs['facture_nb'];
        $facture_all = $calculs['facture_all'];
        $devis_all = $calculs['devis_all'] + $montant_t;
        $lastdte = $calculs['lastdte'];

        $pdo = $bdd->prepare('UPDATE calculs SET facture_nb=:facture_nb, facture_all=:facture_all, devis_all=:devis_all, lastdte=:lastdte WHERE id_session=:num LIMIT 1');
    
        $pdo->bindValue(':num', $_SESSION['id_session']); //$_SESSION
        $pdo->bindValue(':facture_nb', $facture_nb);
        $pdo->bindValue(':facture_all', $facture_all);
        $pdo->bindValue(':devis_all', $devis_all);
        $pdo->bindValue(':lastdte', $lastdte);
        $pdo->execute();


        //delete tout les articles en plus
        
        $pdoDel = $bdd->prepare('DELETE FROM articles WHERE numeros= ""');
        $pdoDel->execute();
        

    header('Location: ../app-devis-list.php');
    exit();


    
?>