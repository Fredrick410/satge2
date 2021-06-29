<?php

    require_once 'config.php';
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
    session_start();

    $dte = date('d-m-Y');

    $insert = $bdd->prepare('INSERT INTO entreprise (nom_diri, prenom_diri, nameentreprise, emailentreprise, datecreation, passwordentreprise) VALUES(?,?,?,?,?,?)');
    $insert->execute(array(
        htmlspecialchars($_POST['name_diri']),
        htmlspecialchars($_POST['prenom_diri']),
        htmlspecialchars($_POST['nameentreprise']),
        htmlspecialchars($_POST['emailentreprise']),
        htmlspecialchars($dte),
        htmlspecialchars($_POST['passwordentreprise'])
    ));


    $inser = $bdd->prepare('INSERT INTO calculs (facture_nb, facture_all, facture_all_achat, devis_all, lastdte, nb_facture_achats, nb_facture_ventes, nb_note, nb_avoir, nb_caisse, nb_banque, size_achats, size_ventes, size_note, size_avoir, size_caisse, size_banque, id_session) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
    $inser->execute(array(
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
        htmlspecialchars("0")
    ));

    $inse = $bdd->prepare('INSERT INTO images (images, name_entreprise, id_session) VALUES(?,?,?)');
    $inse->execute(array(
        htmlspecialchars("astro4.gif"),
        htmlspecialchars($_POST['nameentreprise']),
        htmlspecialchars("0")
    ));

    $ins = $bdd->prepare('INSERT INTO membres (nom, prenom, email, tel, dtenaissance, pays, langue, img_membres, name_entreprise, status_membres, role_membres, startdte, note_nb, note_nb_cout, perms_ventes, perms_achats, perms_projets, perms_inventaires, doc_note, doc_note_2, doc_note_3, doc_note_4, doc_note_5, nb_doc_note, id_session) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
    $ins->execute(array(
        htmlspecialchars($_POST['name_diri']),
        htmlspecialchars($_POST['prenom_diri']),
        htmlspecialchars($_POST['emailentreprise']),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars("astro1.gif"),
        htmlspecialchars($_POST['nameentreprise']),
        htmlspecialchars("Active"),
        htmlspecialchars("Manager"),
        htmlspecialchars(date('d-m-Y')),
        htmlspecialchars("0"),
        htmlspecialchars("0"),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars("0"),
        htmlspecialchars("0")
    ));

    $in = $bdd->prepare('INSERT INTO flash (doc_flash, size_files, dte_files, dte_j, dte_m, dte_a, img_files, recent, name_entreprise, id_session) VALUES(?,?,?,?,?,?,?,?,?,?)');
    $in->execute(array(
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

        header('Location: ../dashboard-admin.php');
        exit();


    
?>