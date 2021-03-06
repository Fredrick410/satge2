<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';
require_once 'verif_session_connect_admin.php';

    //Création de Dossier Fiscal
    $name_entreprise = $_POST['crea_societe'];
    $date_control_begin = $_POST['date_control_begin'];
    
    if(isset($_POST['date_control_end'])){
       
        $date_control_end = $_POST['date_control_end'];
    }else{
        $date_control_end = "";
    }
    
    $object_control = $_POST['object_control'];
    

    $insert = $bdd->prepare('INSERT INTO fiscal (name_entreprise, date_control_begin, date_control_end, object_control,statut,trash_statut) 
    VALUES(?,?,?,?,?,?)');
    $insert->execute(array(
        htmlspecialchars($name_entreprise),
        htmlspecialchars($date_control_begin),
        htmlspecialchars($date_control_end),
        htmlspecialchars($object_control),
        htmlspecialchars("Phase de premier rendez-vous"),
        htmlspecialchars("")
    ));


    // Notification Création de Dossier Fiscal
    $findId = $bdd->lastInsertId();
    //echo $findId."<br/>";

    date_default_timezone_set('UTC');
    //echo date('Y-m-d');

    $notif = $bdd->prepare('INSERT INTO notif_back (name_entreprise, date_demande, type_demande, id_session) VALUES(?,?,?,?)');
    $notif->execute(array(
        htmlspecialchars($name_entreprise),
        htmlspecialchars(date('Y-m-d')),
        htmlspecialchars("dossier_fiscal"),
        htmlspecialchars($findId)
    ));

    header('Location: ../control-fiscal.php');
    exit();
?>