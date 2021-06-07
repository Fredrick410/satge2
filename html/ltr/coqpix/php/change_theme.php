<?php

require_once 'config.php';    
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    if($_GET['theme'] == "light"){

        $pdo = $bdd->prepare('UPDATE entreprise SET theme_web=:theme_web WHERE id=:num LIMIT 1');
        $pdo->bindValue(':num', $_GET['num']);
        $pdo->bindValue(':theme_web', "dark");
        $pdo->execute();
  
        header('Location:'.$_GET['path'].'');
        exit();

    }else{

        $pdo = $bdd->prepare('UPDATE entreprise SET theme_web=:theme_web WHERE id=:num LIMIT 1');
        $pdo->bindValue(':num', $_GET['num']);
        $pdo->bindValue(':theme_web', "light");
        $pdo->execute();

        header('Location: '.$_GET['path'].'');
        exit();

    }

    
        
?>
