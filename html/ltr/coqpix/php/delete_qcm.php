<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
require_once 'php/verif_session_connect.php';

        $pdo = $bdd->prepare('DELETE FROM qcm WHERE id=:id');
        $pdo->bindValue(':id', $_GET['id']);
        $pdo->execute();
        header('Location: ../rh-recrutement-entretient.php');
        exit();
?>