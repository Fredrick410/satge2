<?php
session_start();
require_once 'config.php';    
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    if($_GET['type'] == "frais"){

        $requete = explode('!', $_GET['result']);
        $frais_0 = $requete[0];
        $frais_1 = $requete[1];
        $frais_2 = $requete[2];

        $pdoSta = $bdd->prepare('SELECT frais_bilan FROM entreprise WHERE id=:num');
        $pdoSta->bindValue(':num',$_GET['num']);
        $pdoSta->execute();
        $bilan = $pdoSta->fetch();

        if ($bilan['frais_bilan'] == ''.$frais_0.'!'.$frais_1.'!yes') {
                $end = '!no';
        }else{
                $end = '!yes';
        }
        
        $final = ''.$frais_0.'!'.$frais_1.$end;

        $pdo = $bdd->prepare('UPDATE entreprise SET frais_bilan=:frais WHERE id=:num LIMIT 1');
        $pdo->bindValue(':num', $_GET['num']);
        $pdo->bindValue(':frais', $final);   
        $pdo->execute();

    }

    if($_GET['type'] == "greffe"){

        $requete = explode('!', $_GET['result']);
        $greffe_0 = $requete[0];
        $greffe_1 = $requete[1];
        $greffe_2 = $requete[2];

        $pdoSta = $bdd->prepare('SELECT greffe_bilan FROM entreprise WHERE id=:num');
        $pdoSta->bindValue(':num',$_GET['num']);
        $pdoSta->execute();
        $bilan = $pdoSta->fetch();

        if ($bilan['greffe_bilan'] == ''.$greffe_0.'!'.$greffe_1.'!yes') {
                $end = '!no';
        }else{
                $end = '!yes';
        }
        
        $final = ''.$greffe_0.'!'.$greffe_1.$end;

        $pdo = $bdd->prepare('UPDATE entreprise SET greffe_bilan=:greffe WHERE id=:num LIMIT 1');
        $pdo->bindValue(':num', $_GET['num']);
        $pdo->bindValue(':greffe', $final);   
        $pdo->execute();

    }

    if($_GET['type'] == "age"){

        $requete = explode('!', $_GET['result']);
        $age_0 = $requete[0];
        $age_1 = $requete[1];
        $age_2 = $requete[2];

        $pdoSta = $bdd->prepare('SELECT age_bilan FROM entreprise WHERE id=:num');
        $pdoSta->bindValue(':num',$_GET['num']);
        $pdoSta->execute();
        $bilan = $pdoSta->fetch();

        if ($bilan['age_bilan'] == ''.$age_0.'!'.$age_1.'!yes') {
                $end = '!no';
        }else{
                $end = '!yes';
        }
        
        $final = ''.$age_0.'!'.$age_1.$end;

        $pdo = $bdd->prepare('UPDATE entreprise SET age_bilan=:age WHERE id=:num LIMIT 1');
        $pdo->bindValue(':num', $_GET['num']);
        $pdo->bindValue(':age', $final);   
        $pdo->execute();

    }
    

?>
