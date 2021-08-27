<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';
require_once 'verif_session_connect_admin.php';

    $name_entreprise = $_POST['crea_societe'];
    $date_control_begin = $_POST['date_control_begin'];
    $date_control_end = $_POST['date_control_end'];
    $object_control = $_POST['object_control'];
    

    $insert = $bdd->prepare('INSERT INTO fiscal (name_entreprise, date_control_begin, date_control_end, object_control,statut) 
    VALUES(?,?,?,?,?)');
    $insert->execute(array(
        htmlspecialchars($name_entreprise),
        htmlspecialchars($date_control_begin),
        htmlspecialchars($date_control_end),
        htmlspecialchars($object_control),
        htmlspecialchars("NEW")
    ));

    header('Location: ../control-fiscal.php');
    exit();
?>