<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
require_once 'php/verif_session_connect.php';

    if(!empty($_GET['id'] != "")) {
        $id = htmlspecialchars($_GET['id']);
        try {
            $publier = $bdd->prepare("SELECT * FROM qcm WHERE id = :id");
            $publier->bindValue(':id', $id);
            $publier->execute();
            $qcm = $publier->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            var_dump($exception->getMessage());
            exit();
        }
        if(count($qcm) != 1){
            header('Location: ../rh-recrutement-entretient.php');
            exit();
        }
        try {
            $publier = $bdd->prepare("SELECT * FROM question WHERE idqcm = :id");
            $publier->bindValue(':id', $id);
            $publier->execute();
            $questions = $publier->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            var_dump($exception->getMessage());
            exit();
        }
        if(count($questions) == 0){
            header('Location: ../rh-recrutement-entretient.php');
            exit();
        }
        try {
            $publier = $bdd->prepare('UPDATE qcm SET publiee = "oui" WHERE id = :id');
            $publier->bindValue(':id', $id);
            $publier->execute();
        } catch (PDOException $exception) {
            var_dump($exception->getMessage());
            exit();
        }
        header('Location: ../rh-recrutement-entretient.php');
        exit();
    }
    header('Location: ../rh-recrutement-entretient.php');
    exit();
?>