<?php
    
session_start();
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

        // tout delete


        $pdoDel = $bdd->prepare('DELETE FROM entreprise WHERE id=:num LIMIT 1');  
        $pdoDel->bindValue(':num', $_GET['id']);    
        $pdoDel->execute();

        $pdoDel = $bdd->prepare('DELETE FROM calculs WHERE id=:num LIMIT 1');  
        $pdoDel->bindValue(':num', $_GET['id']);    
        $pdoDel->execute();

        $pdoDel = $bdd->prepare('DELETE FROM images WHERE id=:num LIMIT 1');  
        $pdoDel->bindValue(':num', $_GET['id']);    
        $pdoDel->execute();

        $pdoDel = $bdd->prepare('DELETE FROM membres WHERE id=:num LIMIT 1');  
        $pdoDel->bindValue(':num', $_GET['id']);    
        $pdoDel->execute();

        $pdoDel = $bdd->prepare('DELETE FROM flash WHERE id=:num LIMIT 1');  
        $pdoDel->bindValue(':num', $_GET['id']);    
        $pdoDel->execute();

        sleep(1);
        header('Location: ../utilisateurs.php');
        exit();
    
?>