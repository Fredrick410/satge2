<?php
session_start();
require_once 'config.php';    
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    if($_GET['style'] == "greffe"){

        $pdo = $bdd->prepare('UPDATE acte SET depo_greffe=:depo_greffe WHERE code=:num LIMIT 1');
        $pdo->bindValue(':num', $_GET['num']);
        $pdo->bindValue(':depo_greffe', "");   
        $pdo->execute();

        header("Location: ../acte-modification-three-".$_GET['forme'].".php?num=".$_GET['num']."&verif_one=".$_GET['verif_one']."");
        exit();

    }

    if($_GET['style'] == "cfe"){

        $pdo = $bdd->prepare('UPDATE acte SET depo_cfe=:cfe WHERE code=:num LIMIT 1');
        $pdo->bindValue(':num', $_GET['num']);
        $pdo->bindValue(':cfe', "");   
        $pdo->execute();

        header("Location: ../acte-modification-three-".$_GET['forme'].".php?num=".$_GET['num']."&verif_one=".$_GET['verif_one']."");
        exit();
    }

    if($_GET['style'] == "article"){

        $pdoSta = $bdd->prepare('SELECT article_three FROM acte WHERE code=:num');
        $pdoSta->bindValue(':num',$_GET['num']);
        $pdoSta->execute();
        $acte = $pdoSta->fetch();

        if($acte['article_three'] == "yes"){
            $article = "no";
        }elseif($acte['article_three'] == "no"){
            $article = "yes";
        }elseif($acte['article_three'] == ""){
            $article = "yes";
        }

        echo $article;
            
        $pdo = $bdd->prepare('UPDATE acte SET article_three=:article_three WHERE code=:num LIMIT 1');
        $pdo->bindValue(':num', $_GET['num']);
        $pdo->bindValue(':article_three', $article);   
        $pdo->execute();

        header("Location: ../acte-modification-three-".$_GET['forme'].".php?num=".$_GET['num']."&verif_one=".$_GET['verif_one']."");
        exit();
    }

?>
