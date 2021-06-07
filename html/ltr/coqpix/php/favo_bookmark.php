<?php
session_start();
require_once 'config.php';    
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    if($_GET['favo'] == "no"){

        $favo = "yes";

        $pdo = $bdd->prepare('UPDATE bookmark SET favorite_search=:favorite_search WHERE id=:num LIMIT 1');
        $pdo->bindValue(':num', $_GET['num']);
        $pdo->bindValue(':favorite_search', $favo);   
        $pdo->execute();

    }else{

        $favo = "no";

        $pdo = $bdd->prepare('UPDATE bookmark SET favorite_search=:favorite_search WHERE id=:num LIMIT 1');
        $pdo->bindValue(':num', $_GET['num']);
        $pdo->bindValue(':favorite_search', $favo);   
        $pdo->execute();

    }

    header("Location: ../bookmark.php");

?>
