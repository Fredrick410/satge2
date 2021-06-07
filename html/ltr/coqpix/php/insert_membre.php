<?php
    session_start();
    require_once 'config.php';
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);


    if(empty($_POST['perms_ventes'])){
        $perms_ventes = "";
    }else{
        $perms_ventes = $_POST['perms_ventes'];
    }

    if(empty($_POST['perms_achats'])){
        $perms_achats = "";
    }else{
        $perms_achats = $_POST['perms_achats'];
    }

    if(empty($_POST['perms_projets'])){
        $perms_projets = "";
    }else{
        $perms_projets = $_POST['perms_projets'];
    }

    if(empty($_POST['perms_inventaires'])){
        $perms_inventaires = "";
    }else{
        $perms_inventaires = $_POST['perms_inventaires'];
    }
    
    $dte = date('d-m-Y');
    $status_membre = "Active";

    $insert = $bdd->prepare('INSERT INTO membres (nom, prenom, email, tel, dtenaissance, pays, langue, img_membres, name_entreprise, status_membres, role_membres, startdte, note_nb, note_nb_cout, perms_ventes, perms_achats, perms_projets, perms_inventaires, doc_note, doc_note_2, doc_note_3, doc_note_4, doc_note_5, nb_doc_note, id_session) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
    $insert->execute(array(
        htmlspecialchars($_POST['nom']),
        htmlspecialchars($_POST['prenom']),
        htmlspecialchars($_POST['email']),
        htmlspecialchars($_POST['tel']),
        htmlspecialchars($_POST['dtenaissance']),
        htmlspecialchars($_POST['pays']),
        htmlspecialchars($_POST['langue']),
        htmlspecialchars($_POST['img_membre']),
        htmlspecialchars($_POST['name_entreprise']),
        htmlspecialchars($status_membre),
        htmlspecialchars($_POST['role_membres']),
        htmlspecialchars($dte),
        htmlspecialchars("0"),
        htmlspecialchars("0"),
        htmlspecialchars($perms_ventes),
        htmlspecialchars($perms_achats),
        htmlspecialchars($perms_projets),
        htmlspecialchars($perms_inventaires),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars("0"),
        htmlspecialchars($_SESSION['id_session'])
    ));

    $updat = $bdd->prepare('UPDATE images SET  images = ?  WHERE name_entreprise = ?');
    $updat->execute(array(
        htmlspecialchars("astro4.gif"),
        htmlspecialchars($_POST['entreprise'])
    ));

    header('Location: ../membres-liste.php');
    exit();
   
?>