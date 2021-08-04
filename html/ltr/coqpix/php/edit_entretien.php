<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
$authorised_roles = array('admin', 'rh');
require_once 'php/verif_session_connect.php';
include 'mail.php';

function validateDate($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
    return $d && $d->format($format) === $date;
}

// On verifie l'existance des parametres
if (isset($_POST['id_entretien']) and isset($_POST['titre_entretien']) and isset($_POST['debut_entretien']) and isset($_POST['fin_entretien']) and isset($_POST['lieu_entretien'])) {
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
        if (!empty($_POST['debut_entretien'])) {
            $debut_entretien = $_POST['debut_entretien'];
            // On verifie le format de date
            // S'il est incorrect on retourne un message d'erreur
            if (!validateDate($debut_entretien)) {
                $response_array['status'] = 'error';
                $response_array['message'] = "Merci de choisir une date de debut d'entretien valide";
                echo json_encode($response_array);
                exit();
            }
        } else {
            $response_array['status'] = 'error';
            $response_array['message'] = "Merci de choisir une date de debut d'entretien";
            echo json_encode($response_array);
            exit();
        }
        if (!empty($_POST['fin_entretien'])) {
            $fin_entretien = $_POST['fin_entretien'];
            // On verifie le format de date
            // S'il est incorrect on retourne un message d'erreur
            if (!validateDate($fin_entretien)) {
                $response_array['status'] = 'error';
                $response_array['message'] = "Merci de choisir une date de fin d'entretien valide";
                echo json_encode($response_array);
                exit();
            }
        } else {
            $response_array['status'] = 'error';
            $response_array['message'] = "Merci de choisir une date de fin d'entretien";
            echo json_encode($response_array);
            exit();
        }
        if (!empty($_POST['titre_entretien'])) {
            $titre_entretien = htmlspecialchars($_POST['titre_entretien']);
        } else {
            $response_array['status'] = 'error';
            $response_array['message'] = "Merci d'entrer un titre";
            echo json_encode($response_array);
            exit();
        }
        if (!empty($_POST['lieu_entretien'])) {
            $lieu_entretien = htmlspecialchars($_POST['lieu_entretien']);
        } else {
            $response_array['status'] = 'error';
            $response_array['message'] = "Merci d'entrer un lieu";
            echo json_encode($response_array);
            exit();
        }
    } catch (Exception $e) {
        $response_array['status'] = 'error';
        $response_array['message'] = $e->getMessage();
        echo json_encode($response_array);
        exit();
    }

    // On met à jour l'entretien
    try {
        $update = $bdd->prepare('UPDATE entretien SET titre_entretien = ?, debut_entretien = ?, fin_entretien = ?, lieu_entretien = ? WHERE id_entretien = ?');
        $update->execute(array(
            $titre_entretien,
            $debut_entretien,
            $fin_entretien,
            $lieu_entretien,
            $id_entretien
        ));
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
        "Conformement à ce qui était retenu, l'entretien aura maintenant lieu le " . explode(" ", $debut_entretien)[0] . " de " . explode(" ", $debut_entretien)[1] . " à " . explode(" ", $fin_entretien)[1] . ".\n\n" .
        "En cas d'imprévu, merci de nous le signaler à cette adresse: " . $entreprise['emailentreprise'] . ".\n\n" .
        "Bien Cordialement\n\n" .
        "Service des Ressources Humaines.\n\n" .
        $entreprise['nameentreprise'].".\n\n" .
        "Envoyé par Coqpix.";

    $sujet = 'Votre candidature pour le poste de ' . $annonce['poste'] . ' au sein de ' . $entreprise['nameentreprise'] . ".";

    $mail = [
        'nom_recepteur' => $candidature['nom_candidat'] . " " . $candidature['prenom_candidat'],
        'adresse_recepteur' => $candidature['email_candidat'],
        'nom_emetteur' => "Service des ressources humaines",
        'adresse_emetteur' => "rh-noreply@". $_SERVER['SERVER_NAME'],
        'sujet' => $sujet,
        'message' => $message
    ];

    $sent = email($mail);
    if ($sent) {
        $message = "Vous venez de convier le candidat " . $candidature['nom_candidat'] . " " . $candidature['prenom_candidat'] . " à un entretien pour le poste de " . $annonce['poste'] . " le " . explode(" ", $debut_entretien)[0] . " de " . explode(" ", $debut_entretien)[1] . " à " . explode(" ", $fin_entretien)[1] . ".\n\n" .
            "Bien Cordialement.\n\n" .
            "Service des Ressources Humaines.\n\n" .
            "Envoyé par Coqpix.";

        $sujet = "Vos entretiens avec " . $candidature['nom_candidat'] . " " . $candidature['prenom_candidat'] . " pour sa candidature pour le poste de " . $annonce['poste'] . " au sein de votre entreprise.";

        $mail = [
            'nom_recepteur' => $entreprise['nameentreprise'],
            'adresse_recepteur' => $entreprise['emailentreprise'],
            'nom_emetteur' => "Service des ressources humaines",
            'adresse_emetteur' => "rh-noreply@". $_SERVER['SERVER_NAME'],
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
