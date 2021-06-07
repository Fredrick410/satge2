<?php 
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';

    $name_task = $_POST['name_task'];
    $favo_task = "";
    $dte_crea = date('d/m/Y');
    $dte_echeance = $_POST['dte_echeance'];
    $pour_task = $_POST['pour_task'];
    $statut_task = "en cours";

    if($_GET['type'] == "compta"){
        
        $insert = $bdd->prepare('INSERT INTO task_compta (name_task , favo_task, dte_crea, dte_echeance, pour_task, statut_task) VALUES(?,?,?,?,?,?)');
        $insert->execute(array(
            htmlspecialchars($name_task),
            htmlspecialchars($favo_task),
            htmlspecialchars($dte_crea),
            htmlspecialchars($dte_echeance),
            htmlspecialchars($pour_task),
            htmlspecialchars($statut_task)
        ));

        header('Location: ../task-compta.php');
        exit();

    }

    if($_GET['type'] == "sociale"){

        $insert = $bdd->prepare('INSERT INTO task_sociale (name_task , favo_task, dte_crea, dte_echeance, pour_task, statut_task) VALUES(?,?,?,?,?,?)');
        $insert->execute(array(
            htmlspecialchars($name_task),
            htmlspecialchars($favo_task),
            htmlspecialchars($dte_crea),
            htmlspecialchars($dte_echeance),
            htmlspecialchars($pour_task),
            htmlspecialchars($statut_task)
        ));

        header('Location: ../task-sociale.php');
        exit();

    }

    if($_GET['type'] == "fisca"){

        $insert = $bdd->prepare('INSERT INTO task_fisca (name_task , favo_task, dte_crea, dte_echeance, pour_task, statut_task) VALUES(?,?,?,?,?,?)');
        $insert->execute(array(
            htmlspecialchars($name_task),
            htmlspecialchars($favo_task),
            htmlspecialchars($dte_crea),
            htmlspecialchars($dte_echeance),
            htmlspecialchars($pour_task),
            htmlspecialchars($statut_task)
        ));

        header('Location: ../task-fisca.php');
        exit();

    }

?>