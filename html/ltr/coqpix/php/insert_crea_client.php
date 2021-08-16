<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';

    $name_crea = $_POST['crea_societe'];
    $email_crea = $_POST['email_crea'];

    $password_verif = $_POST['password_verif'];
    $password_temp = $_POST['password_crea'];
    $password_crea = crypt($_POST['password_crea'], '5c725a26307c3b5170634a7e2b');
    if($password_temp != $password_verif){ //si l'utilisateur a entré 2 mots de passes différents lors de la verif
        header('Location: ../creation-societe.php'); //on revient sur la page de crea
        exit();
    };

    $img_crea = !empty($_FILES['img_crea']['name']) ? $_FILES['img_crea']['name'] : "crea.png";
    $date_crea = date("d-m-Y");
    $date_crea_j = date("d");
    $date_crea_j_lettre = date("D");
    $date_crea_d = date("m");
    $date_crea_a = date("Y");
    $date_crea_h = date("H");
    $date_crea_m = date("i");
    $nom_diri = $_POST['nom_diri'];
    $prenom_diri = $_POST['prenom_diri'];
    $tel_diri = $_POST['tel_diri'];
    $email_diri = $_POST['email_crea'];
    $status_crea = $_POST['status_crea'];
    $new_user = "crea_societe";
    $notification_crea = "0";
    $notification_admin = "1";
    
    $insert = $bdd->prepare('INSERT INTO crea_societe (name_crea, email_crea, password_crea, img_crea, date_crea, date_crea_j, date_crea_j_lettre, date_crea_d, date_crea_a, date_crea_h, date_crea_m, nom_diri, prenom_diri, tel_diri, email_diri, adresse_diri, ville_diri, cp_diri, status_crea, secteur_dactivite, favorite_crea, new_user, message_crea, note_crea, notification_crea, notification_admin, doc_domiciliation, doc_contrat, estimation_contrat, portefeuille_contrat, doc_statuts, doc_nomination, doc_depot, doc_pouvoir, doc_pieceid, doc_cerfaM0, doc_annonce, doc_cerfaMBE, doc_attestation, doc_justificatifss, doc_justificatifd, doc_xp, doc_peirl, doc_affectation, frais, honoraire, depo_greffe, depo_cfe, depo_domi, article_three) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
    $insert->execute(array(
        htmlspecialchars($name_crea),
        htmlspecialchars($email_crea),
        htmlspecialchars($password_crea),
        htmlspecialchars($img_crea),
        htmlspecialchars($date_crea),
        htmlspecialchars($date_crea_j),
        htmlspecialchars($date_crea_j_lettre),
        htmlspecialchars($date_crea_d),
        htmlspecialchars($date_crea_a),
        htmlspecialchars($date_crea_h),
        htmlspecialchars($date_crea_m),
        htmlspecialchars($nom_diri),
        htmlspecialchars($prenom_diri),
        htmlspecialchars($tel_diri),
        htmlspecialchars($email_diri),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars($status_crea),
        htmlspecialchars(""),
        htmlspecialchars("Youpi Pixa , un nouveau membre nous a rejoint !!!"),
        htmlspecialchars($new_user),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars($notification_crea),
        htmlspecialchars($notification_admin),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars("false"),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars("")
    )); 

        header('Location: ../../../../');
        exit();

?>