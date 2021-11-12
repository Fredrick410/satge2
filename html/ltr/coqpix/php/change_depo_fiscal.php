<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';
require_once 'verif_session_connect_admin.php';

    $pdo = $bdd->prepare('SELECT * FROM fiscal WHERE id=:num');
    $pdo->bindValue(':num',$_GET['num']);
    $pdo->execute();
    $societe = $pdo->fetch();

    if ($_GET['style'] == "dateD"){
        
        $pdo2 = $bdd->prepare('UPDATE fiscal SET date_control_begin=:date_begin WHERE id=:num LIMIT 1');
        $pdo2->bindvalue(':num',$_GET['num']);
        $pdo2->bindvalue(':date_begin',''.$societe['date_control_begin'].'!edit');
        $pdo2->execute();

    }

    if ($_GET['style'] == "dateF"){
        
        $pdo2 = $bdd->prepare('UPDATE fiscal SET date_control_end=:date_end WHERE id=:num LIMIT 1');
        $pdo2->bindvalue(':num',$_GET['num']);
        $pdo2->bindvalue(':date_end',''.$societe['date_control_end'].'!edit');
        $pdo2->execute();

    }

    if ($_GET['style'] == "object"){

        $pdo2 = $bdd->prepare('UPDATE fiscal SET object_control=:object_control WHERE id=:num LIMIT 1');
        $pdo2->bindvalue(':num',$_GET['num']);
        $pdo2->bindvalue(':object_control',''.$societe['object_control'].'!edit');
        $pdo2->execute();

    }

    header('Location: ../control-fiscal-view.php?num='.$_GET['num'].'');
    exit();
?>