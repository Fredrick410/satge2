<?php
session_start();
require_once 'config.php';    
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    if($_GET['type'] == "yes"){
        $incrementation = "no";
    }else{
        $incrementation = "yes";
    }

    $pdo = $bdd->prepare('UPDATE entreprise SET incrementation=:incrementation WHERE id=:num LIMIT 1');
    $pdo->bindValue(':num', $_SESSION['id_session']);
    $pdo->bindValue(':incrementation', $incrementation);
    $pdo->execute();
        
    header('Location: '.$_GET['url'].'');
    exit();
        
?>
