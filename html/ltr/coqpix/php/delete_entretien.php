<?php
require_once 'verif_session_connect.php';
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
include 'mail.php';

// On verifie l'existance des parametres
if (isset($_POST['id_entretien'])) {
    // On verifie si les parametres sont non vides
    // Si oui, on retourne un message d'erreur
    try {
        if (!empty($_POST['id_entretien'])) {
            $id_entretien = htmlspecialchars($_POST['id_entretien']);
        } else {
            $response_array['status'] = 'error';
            $response_array['message'] = "Entretien inexistant";
            echo json_encode($response_array);
            exit();
        }
    } catch (Exception $e) {
        $response_array['status'] = 'error';
        $response_array['message'] = $e->getMessage();
        echo json_encode($response_array);
        exit();
    }

    // On verifie l'existence du candidat
    try {
        $update = $bdd->prepare("SELECT * FROM rh_candidature WHERE id=(SELECT id_candidature FROM entretien WHERE id_entretien = :id)");
        $update->bindValue(':id', $id_entretien, PDO::PARAM_INT);
        $update->execute();
        $candidature = $update->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $response_array['status'] = 'error';
        $response_array['message'] = $e->getMessage();
        echo json_encode($response_array);
        exit();
    }

    try {
        $update = $bdd->prepare("SELECT * FROM entretien WHERE id_entretien=:id");
        $update->bindValue(':id', $id_entretien, PDO::PARAM_INT);
        $update->execute();
        $entretien = $update->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $response_array['status'] = 'error';
        $response_array['message'] = $e->getMessage();
        echo json_encode($response_array);
        exit();
    }

    // On met à jour l'entretien
    try {
        $update = $bdd->prepare('DELETE FROM entretien WHERE id_entretien = :id');
        $update->bindValue(':id', $id_entretien, PDO::PARAM_INT);
        $update->execute();
    } catch (Exception $e) {
        $response_array['status'] = 'error';
        $response_array['message'] = $e->getMessage();
        echo json_encode($response_array);
        exit();
    }

    $pdoSta = $bdd->prepare('SELECT * FROM entreprise WHERE id = :num');
    $pdoSta->bindValue(':num', $_SESSION['id_session'], PDO::PARAM_INT); //$_SESSION
    $pdoSta->execute();
    $entreprise = $pdoSta->fetch();

    $explode = explode(';', $candidature['key_candidat']);
    $num = $explode[2];
    try {
        $pdoSta = $bdd->prepare('SELECT * FROM rh_annonce WHERE id=:num');
        $pdoSta->bindValue(':num', $num);
        $pdoSta->execute();
        $annonce = $pdoSta->fetch();
    } catch (PDOException $exception) {
        $response_array['status'] = 'error';
        $response_array['message'] = $e->getMessage();
        echo json_encode($response_array);
        exit();
    }

    $message = "Bonjour " . $candidature['nom_candidat'] . " " . $candidature['prenom_candidat'] . ",\n\n" .
        "Conformement à ce qui était retenu, l'entretien devant avoir lieu le " . explode(" ", $entretien['debut_entretien'])[0] . " de " . explode(" ", $entretien['debut_entretien'])[1] . " à " . explode(" ", $entretien['fin_entretien'])[1] . " a été annulé.\n\n" .
        "Bien Cordialement.\n\n" .
        "Service des Ressources Humaines.\n\n" .
        "Envoyé par Coqpix.";

    $sujet = 'Votre candidature pour le poste de ' . $annonce['poste'] . ' au sein de ' . $entreprise['nameentreprise'] . ".";

    $mail = [
        'nom_recepteur' => $candidature['nom_candidat'] . " " . $candidature['prenom_candidat'],
        'adresse_recepteur' => $candidature['email_candidat'],
        'nom_emetteur' => "Service des ressources humaines",
        'adresse_emetteur' => $entreprise['emailentreprise'],
        'sujet' => $sujet,
        'message' => $message
    ];

    $sent = email($mail);
    if ($sent) {
        $message = "Vous venez d'annuler un entretien avec le candidat " . $candidature['nom_candidat'] . " " . $candidature['prenom_candidat'] . " pour le poste de " . $annonce['poste'] . " qui devait avoir lieu le " . explode(" ", $entretien['debut_entretien'])[0] . " de " . explode(" ", $entretien['debut_entretien'])[1] . " a " . explode(" ", $entretien['fin_entretien'])[1] . ".\n\n" .
            "Bien Cordialement.\n\n" .
            "Service des Ressources Humaines.\n\n" .
            "Envoyé par Coqpix.";

        $sujet = "Vos entretiens avec " . $candidature['nom_candidat'] . " " . $candidature['prenom_candidat'] . " pour sa candidature pour le poste de " . $annonce['poste'] . " au sein de votre entreprise.";

        $mail = [
            'nom_recepteur' => $entreprise['nameentreprise'],
            'adresse_recepteur' => $entreprise['emailentreprise'],
            'nom_emetteur' => "Service des ressources humaines",
            'adresse_emetteur' => "rh-noreply@coqpix.com",
            'sujet' => $sujet,
            'message' => $message
        ];

        $sent = email($mail);
    }
}
// On retourne un code de success
$response_array['status'] = 'success';
echo json_encode($response_array);
exit();
