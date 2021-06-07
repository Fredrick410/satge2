<?php
session_start();
require_once 'config.php';    
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);


    $requete = explode('!', $_GET['result']);
    $honoraire_av = $requete[0];

    $pdoSta = $bdd->prepare('SELECT * FROM crea_societe WHERE id=:num');
    $pdoSta->bindValue(':num',$_GET['num']);
    $pdoSta->execute();
    $crea = $pdoSta->fetch();

    if ($crea['honoraire'] == ''.$honoraire_av.'!yes') {
        $end = '!no';
    }else{
        $end = '!yes';
    }
    
    $final = $honoraire_av.$end;

    $pdo = $bdd->prepare('UPDATE crea_societe SET honoraire=:honoraire WHERE id=:num LIMIT 1');
    $pdo->bindValue(':num', $_GET['num']);
    $pdo->bindValue(':honoraire', $final);   
    $pdo->execute();

    echo $final;

?>
