<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';
require_once 'verif_session_connect.php';

        $pdo = $bdd->prepare('DELETE FROM question WHERE id=:id');
        $pdo->bindValue(':id', $_GET['id']);
        $pdo->execute();
        $id = htmlspecialchars($_GET['idqcm']);
        header("Location: ../rh-recrutement-entretient-question.php?id=$id");
        exit();
?>