<?php
    
session_start();
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

        $pdoDel = $bdd->prepare('DELETE FROM articles WHERE id=:num AND id_session =:id');
        
        $pdoDel->bindValue(':num', $_GET['num']);
        $pdoDel->bindValue(':id', $_SESSION['id_session']); //$_SESSION
        
        $pdoDel->execute();

    
        sleep(1);
        header('Location: ../app-invoice-edit.php?numfacture='.$_GET['numfacture'].'');
        exit();
    
?>