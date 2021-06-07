<?php

session_start();
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

        $pdoDel = $bdd->prepare('DELETE FROM etiquette_bookmark WHERE id=:num LIMIT 1');        
        $pdoDel->bindValue(':num', $_GET['num']);       
        $pdoDel->execute();
        header('Location: ../bookmark.php');
        exit();
?>