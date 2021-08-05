<?php

require_once 'verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';

    $insert = $bdd->prepare('INSERT INTO fournisseur (name_fournisseur, nom, prenom, adresse_diri, tel_diri, email_diri, numsiret, tvaintracom, pays, adresse, departement, secteur, tel, siteweb, email, iban, id_session) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
    $insert->execute(array(
        htmlspecialchars($_POST['name_fournisseur']),
        htmlspecialchars($_POST['nom']),
        htmlspecialchars($_POST['prenom']),
        htmlspecialchars($_POST['adresse_diri']),
        htmlspecialchars($_POST['tel_diri']),
        htmlspecialchars($_POST['email_diri']),
        htmlspecialchars($_POST['numsiret']),
        htmlspecialchars($_POST['tvaintracom']),
        htmlspecialchars($_POST['pays']),
        htmlspecialchars($_POST['adresse']),
        htmlspecialchars($_POST['departement']),
        htmlspecialchars($_POST['secteur']),
        htmlspecialchars($_POST['tel']),
        htmlspecialchars($_POST['siteweb']),
        htmlspecialchars($_POST['email']),
        htmlspecialchars($_POST['iban']),
        htmlspecialchars($_SESSION['id_session'])
    ));

    header('Location: ../article-add.php');

?>