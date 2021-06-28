<?php
require_once 'verif_session_connect_admin.php';
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    if($_POST['libelle'] != "") {
        try {
            $insert = $bdd->prepare("INSERT INTO qcm(libelle, auteur) VALUES(?, (SELECT nameentreprise FROM admin WHERE id = ?))");
            $insert->execute(array(
                htmlspecialchars($_POST['libelle']),
                htmlspecialchars($_SESSION['id_admin']) //$_SESSION
            ));
        } catch (PDOException $exception) {
            var_dump($exception->getMessage());
            exit();
        }
        echo '../recrutement-list.php';
        exit();
    }
    exit();
