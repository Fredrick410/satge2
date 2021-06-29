<?php
require_once 'verif_session_connect_admin.php';
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    if(!empty($_GET['id'] != "")) {
        $id = htmlspecialchars($_GET['id']);
        var_dump($id);
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
            header('Location: ../recrutement-list.php');
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
            header('Location: ../recrutement-list.php');
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
        header('Location: ../recrutement-list.php');
        exit();
    }
    header('Location: ../recrutement-list.php');
    exit();
?>