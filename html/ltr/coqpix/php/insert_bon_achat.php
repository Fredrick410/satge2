<?php
session_start();
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    // vide

    if($_POST['numerosbon'] == ""){
        $numerosbon = "0000";
    }else{
        $numerosbon = $_POST['numerosbon'];
    }

    if($_POST['dte'] == ""){
        $dte = "0000-00-00";
    }else{
        $dte = $_POST['dte'];
    }

    if($_POST['commande'] == ""){
        $commande = "Commande en cours de traitement";
    }else{
        $commande = $_POST['commande'];
    }

    if($_POST['note'] == ""){
        $note = "Pas de commentaire";
    }else{
        $note = $_POST['note'];
    }

    // end vide 

    if($_POST['statut'] == "NON PAYE"){
        $color = "badge badge-light-danger badge-pill";
    }else{
        $color = "badge badge-light-success badge-pill";
    }

    $insert = $bdd->prepare('INSERT INTO bon_commande (numerosbon, dte, dateecheance, nom_bon, commande, refbon, modalite, monnaie, note, status_bon, status_color, etiquette, id_session, descrip, numerosfournisseur) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
    $insert->execute(array(
        htmlspecialchars($numerosbon),
        htmlspecialchars($dte),
        htmlspecialchars($_POST['dateecheance']),
        htmlspecialchars($_POST['nom_bon']),
        htmlspecialchars($commande),
        htmlspecialchars($_POST['refbon']),
        // htmlspecialchars($adresse),
        // htmlspecialchars($email),
        // htmlspecialchars($tel),
        // htmlspecialchars($departement),
        htmlspecialchars($_POST['modalite']),
        htmlspecialchars($_POST['monnaie']),
        htmlspecialchars($note),
        htmlspecialchars($_POST['statut']),
        htmlspecialchars($color),
        htmlspecialchars($_POST['etiquette']),
        htmlspecialchars($_SESSION['id_session']), //$_SESSION
        htmlspecialchars($_POST['descrip']),
        // htmlspecialchars($_POST['nom_fournisseur']),
        htmlspecialchars($_POST['numerosfournisseur'])
    ));

        $pdoA = $bdd->prepare('UPDATE articles SET typ="bonachat" WHERE typ="" AND numeros=:numeros AND id_session=:num');  
        $pdoA->bindValue(':num', $_SESSION['id_session']); //$_SESSION
        $pdoA->bindValue(':numeros', $numerosarticle);
        $pdoA->execute();

        $pdoF = $bdd->prepare('UPDATE articles SET typ="bonachat" WHERE typ="" AND numeros=:numeros AND id_session=:num');  
        $pdoF->bindValue(':num', $_SESSION['id_session']); //$_SESSION
        $pdoF->bindValue(':numeros', $numerosarticle);
        $pdoF->execute();

        //calculs

        $pdoS = $bdd->prepare('SELECT * FROM calculs WHERE id_session = :num');
        $pdoS->bindValue(':num',$_SESSION['id_session']); // $_SESSION
        $pdoS->execute();
        $calculs = $pdoS->fetch();

    try{
  
        $sql = "SELECT SUM(ROUND(T.TOTAL, 2)) as MONTANT_T FROM ( SELECT cout, quantite, (cout * quantite) as TOTAL FROM articles WHERE id_session = :num AND numeros=:numeros AND typ='bonachat' ) T ";
            
        $req = $bdd->prepare($sql);
        $req->bindValue(':num',$_SESSION['id_session']); //$_SESSION
        $req->bindValue(':numeros',$_POST['numeroarticle']); 
        $req->execute();
        $res = $req->fetch();
        }catch(Exception $e){
            echo "Erreur " . $e->getMessage();
        }

    // delete tout les articles en plus
        
    $pdoDel = $bdd->prepare('DELETE FROM articles WHERE numeros= ""');
    $pdoDel->execute();

    header('Location: ../app-bon-achat-list.php');
    exit();


    
?>