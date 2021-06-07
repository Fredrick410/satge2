<?php
session_start();
require_once 'config.php';    
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    if($_GET['style'] == "greffe"){

        $pdo = $bdd->prepare('UPDATE crea_societe SET depo_greffe=:depo_greffe WHERE id=:num LIMIT 1');
        $pdo->bindValue(':num', $_GET['num']);
        $pdo->bindValue(':depo_greffe', "");   
        $pdo->execute();

        header("Location: ../creation-view-".$_GET['forme'].".php?num=".$_GET['num']."");
        exit();

    }

    if($_GET['style'] == "cfe"){

        $pdo = $bdd->prepare('UPDATE crea_societe SET depo_cfe=:cfe WHERE id=:num LIMIT 1');
        $pdo->bindValue(':num', $_GET['num']);
        $pdo->bindValue(':cfe', "");   
        $pdo->execute();

        header("Location: ../creation-view-".$_GET['forme'].".php?num=".$_GET['num']."");
        exit();
    }

    if($_GET['style'] == "article"){

        $pdoSta = $bdd->prepare('SELECT * FROM crea_societe WHERE id=:num');
        $pdoSta->bindValue(':num',$_GET['num']);
        $pdoSta->execute();
        $crea = $pdoSta->fetch();

        if($crea['article_three'] == "yes"){
            $article = "no";
        }elseif($crea['article_three'] == "no"){
            $article = "yes";
        }elseif($crea['article_three'] == ""){
            $article = "yes";
        }
            
        

        $pdo = $bdd->prepare('UPDATE crea_societe SET article_three=:article_three WHERE id=:num LIMIT 1');
        $pdo->bindValue(':num', $_GET['num']);
        $pdo->bindValue(':article_three', $article);   
        $pdo->execute();

        header("Location: ../creation-view-".$_GET['forme'].".php?num=".$_GET['num']."");
        exit();
    }

?>
