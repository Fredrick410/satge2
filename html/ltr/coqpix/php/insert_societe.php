<?php

    require_once 'config.php';
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
    session_start();

    $dte = date('d-m-Y');

    $insert = $bdd->prepare('INSERT INTO entreprise (nom_diri, prenom_diri, nameentreprise, emailentreprise, datecreation) VALUES(?,?,?,?,?)');
    $insert->execute(array(
        htmlspecialchars($_POST['name_diri']),
        htmlspecialchars($_POST['prenom_diri']),
        htmlspecialchars($_POST['nameentreprise']),
        htmlspecialchars($_POST['emailentreprise']),
        htmlspecialchars($dte)
    ));

    $query = $bdd->prepare('SELECT last_insert_id() AS id FROM entreprise');
    $query->execute();
    $id_entreprise = $query->fetch()['id'];

    $insert = $bdd->prepare('INSERT INTO calculs (facture_nb, facture_all, facture_all_achat, devis_all, lastdte, nb_facture_achats, nb_facture_ventes, nb_note, nb_avoir, nb_caisse, nb_banque, size_achats, size_ventes, size_note, size_avoir, size_caisse, size_banque, id_session) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
    $insert->execute(array(
        htmlspecialchars("0"),
        htmlspecialchars("0"),
        htmlspecialchars("0"),
        htmlspecialchars("0"),
        htmlspecialchars($dte),
        htmlspecialchars("0"),
        htmlspecialchars("0"),
        htmlspecialchars("0"),
        htmlspecialchars("0"),
        htmlspecialchars("0"),
        htmlspecialchars("0"),
        htmlspecialchars("0"),
        htmlspecialchars("0"),
        htmlspecialchars("0"),
        htmlspecialchars("0"),
        htmlspecialchars("0"),
        htmlspecialchars("0"),
        htmlspecialchars($id_entreprise)
    ));

    $insert = $bdd->prepare('INSERT INTO membres (nom, prenom, email, password_membre, img_membres, name_entreprise, status_membres, role_membres, startdte, id_session) VALUES(?,?,?,?,?,?,?,?,?,?)');
    $insert->execute(array(
        htmlspecialchars($_POST['name_diri']),
        htmlspecialchars($_POST['prenom_diri']),
        htmlspecialchars($_POST['emailentreprise']),
        htmlspecialchars(crypt($_POST['passwordentreprise'], '5c725a26307c3b5170634a7e2b')),
        htmlspecialchars("astro1.gif"),
        htmlspecialchars($_POST['nameentreprise']),
        htmlspecialchars("New"),
        htmlspecialchars("Manager"),
        htmlspecialchars(date('d-m-Y')),
        htmlspecialchars($id_entreprise)
    ));

    $insert = $bdd->prepare('INSERT INTO flash (doc_flash, size_files, dte_files, dte_j, dte_m, dte_a, img_files, recent, name_entreprise, id_session) VALUES(?,?,?,?,?,?,?,?,?,?)');
    $insert->execute(array(
        htmlspecialchars($_POST['emailentreprise']),
        htmlspecialchars("0"),
        htmlspecialchars("0"),
        htmlspecialchars("0"),
        htmlspecialchars("0"),
        htmlspecialchars("0"),
        htmlspecialchars("0"),
        htmlspecialchars("0"),
        htmlspecialchars("0"),
        htmlspecialchars("0")
    ));

        header('Location: ../utilisateurs.php');
        exit();


    
?>