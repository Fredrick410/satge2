<?php

session_start();
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

if ($_GET['fonction'] == "change") {

    if ($_GET['statut'] == "actif") {
        $statut = "pause";
    } else {
        $statut = "actif";
    }
    if ($statut == "actif") {
        if ($_GET['active'] === 'now') {
            $pdo = $bdd->prepare('UPDATE rh_annonce SET statut=:statut, date_activation=NULL WHERE id=:num LIMIT 1');
            $pdo->bindValue(':num', $_GET['num']);
            $pdo->bindValue(':statut', $statut);
            $pdo->execute();
        } else {
            $pdo = $bdd->prepare('UPDATE rh_annonce SET statut=:statut, date_activation=:date_activation WHERE id=:num LIMIT 1');
            $pdo->bindValue(':num', $_GET['num']);
            $pdo->bindValue(':date_activation', $_GET['date']);
            $pdo->bindValue(':statut', $statut);
            $pdo->execute();
        }
    } else {
        $pdo = $bdd->prepare('UPDATE rh_annonce SET statut=:statut WHERE id=:num LIMIT 1');
        $pdo->bindValue(':num', $_GET['num']);
        $pdo->bindValue(':statut', $statut);
        $pdo->execute();
    }
    echo $statut;


    header("Location: ../rh-recrutement-list.php");
    exit();
}

if ($_GET['fonction'] == "delete") {

    $pdoDe = $bdd->prepare('DELETE FROM rh_annonce WHERE id=:num');
    $pdoDe->bindValue(':num', $_GET['num']);
    $pdoDe->execute();

    header("Location: ../rh-recrutement-list.php");
    exit();
}
