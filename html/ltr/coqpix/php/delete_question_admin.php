<?php
    
session_start();
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

        $pdo = $bdd->prepare('DELETE FROM question WHERE id=:id');
        $pdo->bindValue(':id', $_GET['id']);
        $pdo->execute();
        $id = $_GET['idqcm'];
        header("Location: ../recrutement-list-question.php?id=$id");
        exit();
?>