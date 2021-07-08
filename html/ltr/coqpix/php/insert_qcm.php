<?php
require_once 'verif_session_connect.php';
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    if($_POST['libelle'] != "") {
        try {
            $insert = $bdd->prepare("INSERT INTO qcm(libelle, auteur) VALUES(?, (SELECT nameentreprise FROM entreprise WHERE id = ?))");
            $insert->execute(array(
                htmlspecialchars($_POST['libelle']),
                htmlspecialchars($_SESSION['id_session']) //$_SESSION
            ));
        } catch (PDOException $exception) {
            var_dump($exception->getMessage());
            exit();
        }
        echo '../rh-recrutement-entretient.php';
        exit();
    }
    exit();
