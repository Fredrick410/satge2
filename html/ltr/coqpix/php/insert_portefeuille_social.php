<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';

    $name_entreprise = htmlspecialchars($_POST['name_entreprise']);
    $nom_diri = htmlspecialchars($_POST['nom_diri']);
    $prenom_diri = htmlspecialchars($_POST['prenom_diri']);
    $tel_diri = htmlspecialchars($_POST['tel_diri']);
    $email_diri = htmlspecialchars($_POST['email_diri']);
    $rib = "no";
    $date_crea = date('d/m/Y');
    $date_crea_d = date('d');
    $date_crea_m = date('m');
    $date_crea_a = date('Y');
    $statut = "actif";

    $insert = $bdd->prepare('INSERT INTO portefeuille_social (name_entreprise, nom_diri, prenom_diri, tel_diri, email_diri, rib, date_crea, date_crea_d, date_crea_m, date_crea_a, statut) VALUES(?,?,?,?,?,?,?,?,?,?,?)');
    $insert->execute(array(
        htmlspecialchars($name_entreprise),
        htmlspecialchars($nom_diri),
        htmlspecialchars($prenom_diri),
        htmlspecialchars($tel_diri),
        htmlspecialchars($email_diri),
        htmlspecialchars($rib),
        htmlspecialchars($date_crea),
        htmlspecialchars($date_crea_d),
        htmlspecialchars($date_crea_m),
        htmlspecialchars($date_crea_a),
        htmlspecialchars($statut)
    ));

    header('Location: ../portefeuille-social.php');
    exit();

?>