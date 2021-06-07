<?php
    
session_start();
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

        $pdoDe = $bdd->prepare('DELETE FROM portefeuille WHERE id=:id');
        $pdoDe->bindValue(':id', $_GET['id']);
        $pdoDe->execute();

        sleep(1);
        header('Location: ../portefeuille.php');
        exit();
?>