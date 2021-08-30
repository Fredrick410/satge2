<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';
$authorised_roles = array('admin', 'rh');
require_once 'verif_session_connect_admin.php';

        $pdo = $bdd->prepare('DELETE FROM question WHERE id=:id');
        $pdo->bindValue(':id', $_GET['id']);
        $pdo->execute();
        $id = htmlspecialchars($_GET['idqcm']);
        header("Location: ../recrutement-list-question.php?id=$id");
        exit();
?>