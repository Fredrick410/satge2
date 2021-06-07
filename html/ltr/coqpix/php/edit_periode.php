<?php

session_start();
require_once 'config.php';    
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    $pdoSta = $bdd->prepare('SELECT * FROM entreprise WHERE id=:num');
    $pdoSta->bindValue(':num',$_GET['num'], PDO::PARAM_INT);
    $pdoSta->execute();
    $entreprise = $pdoSta->fetch();

    $periode = explode(";", $entreprise['forme_tva']);

    $forme = $_POST['forme'];

    $forme_tva = ''.$forme.';'.$periode[1].'';

    $pdo = $bdd->prepare('UPDATE entreprise SET forme_tva=:forme_tva WHERE id=:num LIMIT 1');
    $pdo->bindValue(':forme_tva', $forme_tva);
    $pdo->bindValue(':num', $_GET['num']);
    $pdo->execute();

    header("Location: ../declarationtva-view.php?num=".$_GET['num']."");

?>