<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';

    $pdoSta = $bdd->prepare('SELECT * FROM rh_annonce WHERE id=:num');
    $pdoSta->bindValue(':num',$_GET['num']);
    $pdoSta->execute();
    $annonce = $pdoSta->fetch();
    
    session_start ();

    session_unset ();

    session_destroy ();

    sleep(1);
    header ('location: ../candidature-recrutement.php?'.$annonce['link'].'');
    exit();
?>