<?php

require_once 'config.php';    
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    if($_GET['type'] == "payé"){

        $pdo = $bdd->prepare('UPDATE prelevement_social SET statut=:statut WHERE id=:num LIMIT 1');
        $pdo->bindValue(':num', $_GET['num']);
        $pdo->bindValue(':statut', "Payé");
        $pdo->execute();

        header('Location: ../portefeuille-view-social.php?num='.$_GET['KgUf2Ua274'].'');
        exit();
    }

    if($_GET['type'] == "rejeté"){
        
        $pdo = $bdd->prepare('UPDATE prelevement_social SET statut=:statut WHERE id=:num LIMIT 1');
        $pdo->bindValue(':num', $_GET['num']);
        $pdo->bindValue(':statut', "rejeté");
        $pdo->execute();

        header('Location: ../portefeuille-view-social.php?num='.$_GET['KgUf2Ua274'].'');
        exit();

    }

    if($_GET['type'] == "trash"){

        $pdoDel = $bdd->prepare('DELETE FROM prelevement_social WHERE id=:num LIMIT 1');
        $pdoDel->bindValue(':num', $_GET['num']);
        $pdoDel->execute();

        header('Location: ../portefeuille-view-social.php?num='.$_GET['KgUf2Ua274'].'');
        exit();
        
    }
        
?>
