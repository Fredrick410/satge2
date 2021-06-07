<?php
session_start();
require_once 'config.php';    
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    if($_GET['type'] == "prospect"){
        $pdoSta = $bdd->prepare('SELECT statut FROM portefeuille WHERE id =:num');
        $pdoSta->bindValue(':num', $_GET['num']);
        $pdoSta->execute();
        $portefeuille = $pdoSta->fetch();

        if($portefeuille['statut'] == "prospect"){
            $reload = "prospect!validation";
        }else{
            $reload = "prospect";
        }

        $pdo = $bdd->prepare('UPDATE portefeuille SET statut=:statut WHERE id=:num LIMIT 1');
        $pdo->bindValue(':num', $_GET['num']);
        $pdo->bindValue(':statut', $reload);   
        $pdo->execute();

        header('Location: ../portefeuille.php');
        exit();
    }

    if($_GET['type'] == "passif"){

        $pdo = $bdd->prepare('UPDATE portefeuille SET statut=:statut, raison=:raison WHERE id=:num LIMIT 1');
        $pdo->bindValue(':num', $_GET['num']);
        $pdo->bindValue(':raison', $_POST['raison']);
        $pdo->bindValue(':statut', "passif");   
        $pdo->execute();

        header('Location: ../portefeuille.php');
        exit();

    }

    // if($_GET['type'] == "encours"){
    //     $pdoSta = $bdd->prepare('SELECT statut FROM portefeuille WHERE id =:num');
    //     $pdoSta->bindValue(':num', $_GET['num']);
    //     $pdoSta->execute();
    //     $portefeuille = $pdoSta->fetch();

    //     if($portefeuille['statut'] == "prospect"){
    //         $reload = "prospect!validation";
    //     }else{
    //         $reload = "prospect";
    //     }

    //     $pdo = $bdd->prepare('UPDATE portefeuille SET statut=:statut WHERE id=:num LIMIT 1');
    //     $pdo->bindValue(':num', $_GET['num']);
    //     $pdo->bindValue(':statut', $reload);   
    //     $pdo->execute();

    //     header('Location: ../portefeuille.php');
    //     exit();
    // }

?>
