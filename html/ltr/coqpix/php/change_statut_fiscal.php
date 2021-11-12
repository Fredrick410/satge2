<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';
require_once 'verif_session_connect_admin.php';

    $date = date('Y-m-d');

    $pdoSta = $bdd->prepare('UPDATE fiscal SET statut=:statut WHERE id=:num LIMIT 1');
    $pdoSta->bindValue(':statut','FINISH!'.$date.'');
    $pdoSta->bindValue(':num',$_GET['num']);
    $pdoSta->execute();

    header('Location:../control-fiscal.php');
    exit();

?>