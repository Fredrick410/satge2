<?php

    require_once 'config.php';
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
    session_start();

    $dte = date('d-m-Y');

    $insert = $bdd->prepare('INSERT INTO comptable (email, password_comptable, nom, prenom, role_comptable, new_user, perms, id_session) VALUES(?,?,?,?,?,?,?,?)');
    $insert->execute(array(
        htmlspecialchars($_POST['email']),
        htmlspecialchars($_POST['password']),
        htmlspecialchars($_POST['nom']),
        htmlspecialchars($_POST['prenom']),
        htmlspecialchars("comptable"),
        htmlspecialchars("new"),
        htmlspecialchars("all"),
        htmlspecialchars("0")
    ));

        header('Location: ../comptable.php');
        exit();


    
?>