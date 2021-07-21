<?php
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
include('mail.php');

if (isset($_POST['done']) and $_POST['done'] == "oui") {
    $key = htmlspecialchars($_POST['key']);
    try {
        $pdoStt = $bdd->prepare('SELECT * FROM rh_candidature WHERE key_candidat = :num');
        $pdoStt->bindValue(':num', $key, PDO::PARAM_STR);
        $pdoStt->execute();
        $candidature = $pdoStt->fetch();
    } catch (PDOException $e) {
        $response_array['status'] = 'error';
        $response_array['message'] = $e->GetMessage();
        echo json_encode($response_array);
        exit();
    }
    $explode = explode(';', $candidature['key_candidat']);
    $num = $explode[2];
    try {
        $pdoSta = $bdd->prepare('SELECT * FROM rh_annonce WHERE id=:num');
        $pdoSta->bindValue(':num', $num);
        $pdoSta->execute();
        $annonce = $pdoSta->fetch();
    } catch (PDOException $e) {
        $response_array['status'] = 'error';
        $response_array['message'] = $e->GetMessage();
        echo json_encode($response_array);
        exit();
    }

    $num = $explode[1];

    $pdoS = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
    $pdoS->bindValue(':numentreprise', $num);
    $true = $pdoS->execute();
    $entreprise = $pdoS->fetch();

    $message = "Bonjour " . $candidature['nom_candidat'] . " " . $candidature['prenom_candidat'] . ",\n
        Bravo pour ce premier pas et merci de l’intérêt que vous nous portez à " . $entreprise['nameentreprise'] . ".\n
        Votre candidature au poste de " . $annonce['poste'] . " leur a bien été transmise.\n
        L'équipe de recrutement va l’étudier avec beaucoup d’attention. Nous ne manquerons pas de vous contacter rapidement si votre profil correspond à leurs attentes.\n
        A bientôt !\n
        Service des Ressources Humaines.\n
        Coqpix.";

    $sujet = 'Votre candidature pour le poste de ' . $annonce['poste'] . ' au sein de ' . $entreprise['nameentreprise'] . ".";

    $mail = [
        'nom_recepteur' => $candidature['nom_candidat'] . " " . $candidature['prenom_candidat'],
        'adresse_recepteur' => $candidature['email_candidat'],
        'nom_emetteur' => "Service des ressources humaines",
        'adresse_emetteur' => "hr@coqpix.com",
        'sujet' => $sujet,
        'message' => $message
    ];

    $sent = email($mail);
    if ($sent) {
        $response_array['status'] = 'success';
        $response_array['link'] = 'https://www.google.com/';
    } else {
        $response_array['status'] = 'error';
    }
    echo json_encode($response_array);
    exit();
}
