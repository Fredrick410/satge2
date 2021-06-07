<?php
    
session_start();
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

        $pdoDe = $bdd->prepare('DELETE FROM bookmark WHERE id=:num AND id_session=:id_session');
        $pdoDe->bindValue(':num', $_GET['num']);
        $pdoDe->bindValue(':id_session',$_SESSION['id_session']); //$_SESSION
        $pdoDe->execute();

        header('Location: ../bookmark.php');
        exit();
    
?>