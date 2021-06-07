<?php
    
session_start();
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

        $pdoDel = $bdd->prepare('DELETE FROM other_declaration WHERE id=:id LIMIT 1');        
        $pdoDel->bindValue(':id', $_GET['num']);       
        $pdoDel->execute();
        sleep(0.5);
        header('Location: ../declarationother-view.php?num='.$_GET['id'].'');
        exit();
    
?>