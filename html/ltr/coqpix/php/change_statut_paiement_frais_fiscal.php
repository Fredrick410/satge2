<?php
session_start();
require_once 'config.php';    
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);


    $requete = explode('!', $_GET['result']);
    $frais_av = $requete[0];

    $pdoSta = $bdd->prepare('SELECT * FROM fiscal WHERE id=:num');
    $pdoSta->bindValue(':num',$_GET['num']);
    $pdoSta->execute();
    $societe = $pdoSta->fetch();

    if ($societe['frais'] == ''.$frais_av.'!yes') {
        $end = '!no';
    }else{
        $end = '!yes';
    }
    
    $final = $frais_av.$end;

    $pdo = $bdd->prepare('UPDATE fiscal SET frais=:frais WHERE id=:num LIMIT 1'); 
    $pdo->bindValue(':num', $_GET['num']);
    $pdo->bindValue(':frais', $final);   
    $pdo->execute();

    echo $final;

?>
