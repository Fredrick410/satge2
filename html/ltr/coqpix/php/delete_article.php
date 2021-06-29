<?php
    
session_start();
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

        
        
        $pdoDell = $bdd->prepare('SELECT * FROM article WHERE id=:num');
        $pdoDell->bindValue(':num', $_GET['num']);
        $pdoDell->execute();
        $article = $pdoDell->fetch();

        $image = $article['img'];
        
        $chemin = "../../../../app-assets/images/article/$image";
        if(file_exists($chemin)){
        unlink($chemin);
        }
        
        $pdoDel = $bdd->prepare('DELETE FROM article WHERE id=:num LIMIT 1');
        $pdoDel->bindValue(':num', $_GET['num']);
        $pdoDel->execute();

        sleep(1);
        header('Location: ../article-list.php');
        exit();
    
?>