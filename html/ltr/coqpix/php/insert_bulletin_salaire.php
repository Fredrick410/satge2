<?php
session_start();
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    $name_entreprise = $_POST['name_entreprise'] !== "" ? $_POST['name_entreprise'] : "0";
    $name_membre = $_POST['name_membre'] !== "" ? $_POST['name_membre'] : "0";
    $date_demande = date('d/m/Y');
    $date_donner = "";
    $statut_bulletin = "En cours";
    $message_bulletin = "";
    $files_bulletin = "";
    $secteur_activité = $_POST['secteur_activité'] !== "" ? $_POST['secteur_activité'] : "0";
    $heuredebase = $_POST['heuredebase'] !== "" ? $_POST['heuredebase'] : "0";
    $heuresupp_tp = $_POST['heuresupp_tp'] !== "" ? $_POST['heuresupp_tp'] : "0";
    $heurecompl_tpartiel = $_POST['heurecompl_tpartiel'] !== "" ? $_POST['heurecompl_tpartiel'] : "0";
    $heuredenuit = $_POST['heuredenuit'] !== "" ? $_POST['heuredenuit'] : "0";
    $repas = $_POST['repas'] !== "" ? $_POST['repas'] : "0";
    $indemnitesdet_1A = $_POST['indemnitesdet_1A'] !== "" ? $_POST['indemnitesdet_1A'] : "0";
    $indemnitesdet_1B = $_POST['indemnitesdet_1B'] !== "" ? $_POST['indemnitesdet_1B'] : "0";
    $indemnitesdet_2 = $_POST['indemnitesdet_2'] !== "" ? $_POST['indemnitesdet_2'] : "0";
    $indemnitesdet_3 = $_POST['indemnitesdet_3'] !== "" ? $_POST['indemnitesdet_3'] : "0";
    $indemnitesdet_4 = $_POST['indemnitesdet_4'] !== "" ? $_POST['indemnitesdet_4'] : "0";
    $indemnitesdet_5 = $_POST['indemnitesdet_5'] !== "" ? $_POST['indemnitesdet_5'] : "0";
    $indemnitesdetr_1A = $_POST['indemnitesdetr_1A'] !== "" ? $_POST['indemnitesdetr_1A'] : "0";
    $indemnitesdetr_1B = $_POST['indemnitesdetr_1B'] !== "" ? $_POST['indemnitesdetr_1B'] : "0";
    $indemnitesdetr_2 = $_POST['indemnitesdetr_2'] !== "" ? $_POST['indemnitesdetr_2'] : "0";
    $indemnitesdetr_3 = $_POST['indemnitesdetr_3'] !== "" ? $_POST['indemnitesdetr_3'] : "0";
    $indemnitesdetr_4 = $_POST['indemnitesdetr_4'] !== "" ? $_POST['indemnitesdetr_4'] : "0";
    $indemnitesdetr_5 = $_POST['indemnitesdetr_5'] !== "" ? $_POST['indemnitesdetr_5'] : "0";
    $primes = $_POST['primes'] !== "" ? $_POST['primes'] : "0";
    $remboursementtransport = $_POST['remboursementtransport'] !== "" ? $_POST['remboursementtransport'] : "0";
    $congespayes = $_POST['congespayes'] !== "" ? $_POST['congespayes'] : "0";
    $congessanssolde = $_POST['congessanssolde'] !== "" ? $_POST['congessanssolde'] : "0";
    $congesmaternite = $_POST['congesmaternite'] !== "" ? $_POST['congesmaternite'] : "0";
    $congespaternite = $_POST['congespaternite'] !== "" ? $_POST['congespaternite'] : "0";
    $avantagenature = $_POST['avantagenature'] !== "" ? $_POST['avantagenature'] : "0";
    $id_session = $_SESSION['id_session'];

<<<<<<< HEAD
=======

    $insert = $bdd->prepare('INSERT INTO task_sociale (name_task, dte_crea, dte_echeance, pour_task, statut_task) VALUES(?,?,?,?,?)');
        $insert->execute(array(
        htmlspecialchars("Demande de bulletin de salaire de ".$name_entreprise),
        htmlspecialchars($date_demande),
        htmlspecialchars(date('d/m/y', strtotime('+1 day'))),
        htmlspecialchars("Non défini"),
        htmlspecialchars("en cours")
    ));

    $pdoS = $bdd->query('SELECT LAST_INSERT_ID() as id_task FROM task_sociale');
    $id_task = ($pdoS->fetch()['id_task']);

>>>>>>> 6f1911ef5aed13068443f2acacba0518479933eb
    $insert = $bdd->prepare('INSERT INTO bulletin_salaire (name_entreprise, name_membre, date_demande, date_donner, statut_bulletin, message_bulletin, files_bulletin, secteur_activité, heuredebase, heuresupp_tp, heurecompl_tpartiel, heuredenuit, repas, indemnitesdet_1A, indemnitesdet_1B, indemnitesdet_2, indemnitesdet_3, indemnitesdet_4, indemnitesdet_5, indemnitesdetr_1A, indemnitesdetr_1B, indemnitesdetr_2, indemnitesdetr_3, indemnitesdetr_4, indemnitesdetr_5, primes, remboursementtransport, congespayes, congessanssolde, congesmaternite, congespaternite, avantagenature, id_session) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
    $insert->execute(array(
        htmlspecialchars($name_entreprise),
        htmlspecialchars($name_membre),
        htmlspecialchars($date_demande),
        htmlspecialchars($date_donner),
        htmlspecialchars($statut_bulletin),
        htmlspecialchars($message_bulletin),
        htmlspecialchars($files_bulletin),
        htmlspecialchars($secteur_activité),
        htmlspecialchars($heuredebase),
        htmlspecialchars($heuresupp_tp),
        htmlspecialchars($heurecompl_tpartiel),
        htmlspecialchars($heuredenuit),
        htmlspecialchars($repas),
        htmlspecialchars($indemnitesdet_1A),
        htmlspecialchars($indemnitesdet_1B),
        htmlspecialchars($indemnitesdet_2),
        htmlspecialchars($indemnitesdet_3),
        htmlspecialchars($indemnitesdet_4),
        htmlspecialchars($indemnitesdet_5),
        htmlspecialchars($indemnitesdetr_1A),
        htmlspecialchars($indemnitesdetr_1B),
        htmlspecialchars($indemnitesdetr_2),
        htmlspecialchars($indemnitesdetr_3),
        htmlspecialchars($indemnitesdetr_4),
        htmlspecialchars($indemnitesdetr_5),
        htmlspecialchars($primes),
        htmlspecialchars($remboursementtransport),
        htmlspecialchars($congespayes),
        htmlspecialchars($congessanssolde),
        htmlspecialchars($congesmaternite),
        htmlspecialchars($congespaternite),
        htmlspecialchars($avantagenature),
        htmlspecialchars($id_session)
    ));

<<<<<<< HEAD
=======
    // ajouter notification
    $insert_notif = $bdd->prepare('INSERT INTO notif_back (type_demande, date_demande, name_entreprise, id_session) VALUES(?,?,?,?)');
    $insert_notif->execute(array(
        htmlspecialchars("bulletin_salaire"),
        htmlspecialchars($date_demande),
        htmlspecialchars($name_entreprise),
        htmlspecialchars($id_session)
    ));
        
>>>>>>> 6f1911ef5aed13068443f2acacba0518479933eb
    header('Location: ../bulletin-choose.php');
    exit();

?>