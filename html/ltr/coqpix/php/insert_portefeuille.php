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
    $estimation = htmlspecialchars($_POST['estimation']);
    $prix = "0";
    $lettredemission = "no";
    $rib = "no";
    $date_crea = date('d/m/Y');
    $date_crea_d = date('d');
    $date_crea_m = date('m');
    $date_crea_a = date('Y');
    $date_charge = "";
    $statut = "prospect";
    $dette = "0";
    $prelevement = "";
    $raison = "";
    $date_leave = "";


    $insert = $bdd->prepare('INSERT INTO portefeuille (name_entreprise, nom_diri, prenom_diri, tel_diri, email_diri, estimation, prix, lettredemission, rib, date_crea, date_crea_d, date_crea_m, date_crea_a, date_charge, statut, dette, prevelement, raison, date_leave) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
    $insert->execute(array(
        htmlspecialchars($name_entreprise),
        htmlspecialchars($nom_diri),
        htmlspecialchars($prenom_diri),
        htmlspecialchars($tel_diri),
        htmlspecialchars($email_diri),
        htmlspecialchars($estimation),
        htmlspecialchars($prix),
        htmlspecialchars($lettredemission),
        htmlspecialchars($rib),
        htmlspecialchars($date_crea),
        htmlspecialchars($date_crea_d),
        htmlspecialchars($date_crea_m),
        htmlspecialchars($date_crea_a),
        htmlspecialchars($date_charge),
        htmlspecialchars($statut),
        htmlspecialchars($dette),
        htmlspecialchars($prelevement),
        htmlspecialchars($raison),
        htmlspecialchars($date_leave)
    ));

    header('Location: ../portefeuille.php');
    exit();

?>