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
        $numerosfacture = htmlspecialchars($_POST['numerosdevis']);
    }
    $numeroarticle = htmlspecialchars($_POST['numeroarticle']);
    if($_POST['dte'] == ""){
        $dte = "00-00-00";
    }else{
        $dte = $_POST['dte'];
    }

    if($_POST['nomproduit'] == ""){
        $nomproduit = "nom produit";
    }else{
        $nomproduit = htmlspecialchars($_POST['nomproduit']);
    }

    if($_POST['facturepour'] == ""){
        $facturepour = "Devis pour";
    }else{
        $facturepour = htmlspecialchars($_POST['facturepour']);
    }

    if($_POST['adressefirst'] == ""){
        $adresse = "Adresse";
    }else{
        $adresse = htmlspecialchars($_POST['adressefirst']);
    }

    if($_POST['departementfirst'] == ""){
        $departement = "31100";
    }else{
        $departement = htmlspecialchars($_POST['departementfirst']);
    }

    if($_POST['emailfirst'] == ""){
        $email = "email@email.com";
    }else{
        $email = htmlspecialchars($_POST['emailfirst']);
    }

    if($_POST['telfirst'] == ""){
        $tel = "06.00.00.00.00";
    }else{
        $tel = htmlspecialchars($_POST['telfirst']);
    }

    if($_POST['note'] == ""){
        $note = "Pas de commentaire";
    }else{
        $note = htmlspecialchars($_POST['note']);
    }
    if($_POST['accompte'] == ""){
        $accompte = "O";
    }else{
        $accompte = htmlspecialchars($_POST['accompte']);
    }

    // end vide 

    $insert = $bdd->prepare('INSERT INTO devis (numerosdevis, dte, dateecheance, refdevis, nomproduit, devispour, adresse, email, tel, departement, modalite, monnaie, accompte, note, status_devis, status_color, etiquette, descrip, id_session) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
    $insert->execute(array(
        htmlspecialchars($_POST['numerosdevis']),
        htmlspecialchars($dte),
        htmlspecialchars($_POST['dateecheance']),
        htmlspecialchars($_POST['refdevis']),
        htmlspecialchars($nomproduit),
        htmlspecialchars($_POST['devispour']),
        htmlspecialchars($adresse),
        htmlspecialchars($email),
        htmlspecialchars($tel),
        htmlspecialchars($departement),
        htmlspecialchars($_POST['modalite']),
        htmlspecialchars($_POST['monnaie']),
        htmlspecialchars($accompte),
        htmlspecialchars($note),
        htmlspecialchars("NON PAYE"),
        htmlspecialchars("badge badge-light-danger badge-pill"),
        htmlspecialchars($_POST['etiquette']),
        htmlspecialchars($_POST['descrip']),
        htmlspecialchars($_SESSION['id_session']) //$_SESSION
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