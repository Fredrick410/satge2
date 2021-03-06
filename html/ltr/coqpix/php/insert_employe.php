<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';
require_once 'verif_session_connect.php';
include 'mail.php';

function filter(&$value)
{
    $value = htmlspecialchars($value, ENT_HTML5, 'UTF-8');
}

function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
    return $d && $d->format($format) === $date;
}

// On verifie l'existance des parametres
if (isset($_POST['confirm']) and isset($_POST['idcandidat']) and isset($_POST['observations']) and isset($_POST['missions']) and isset($_POST['startdte']) and isset($_POST['enddte'])) {
    if ($_POST['confirm'] == "confirm") {
        // On verifie si les parametres sont non vides
        // Si oui, on retourne un message d'erreur
        try {
            if (!empty($_POST['observations'])) {
                $observations = htmlspecialchars($_POST['observations']);
            } else {
                $response_array['status'] = 'error';
                $response_array['message'] = "Merci de mettre une observation";
                echo json_encode($response_array);
                exit();
            }
            if (!empty($_POST['missions'])) {
                array_walk_recursive($_POST['missions'], "filter");
                $missions = implode(";", $_POST['missions']);
            } else {
                $response_array['status'] = 'error';
                $response_array['message'] = "Merci de choisir au moins une mission";
                echo json_encode($response_array);
                exit();
            }
            if (!empty($_POST['dtecontrat'])) {
                $dtecontrat = $_POST['dtecontrat'];
                // On verifie le format de date
                // S'il est incorrect on retourne un message d'erreur
                if (!validateDate($dtecontrat)) {
                    $response_array['status'] = 'error';
                    $response_array['message'] = "Merci de choisir une date de signature de contrat valide";
                    echo json_encode($response_array);
                    exit();
                }
            } else {
                $response_array['status'] = 'error';
                $response_array['message'] = "Merci de choisir une date de prise de service";
                echo json_encode($response_array);
                exit();
            }
            if (!empty($_POST['startdte'])) {
                $startdte = $_POST['startdte'];
                // On verifie le format de date
                // S'il est incorrect on retourne un message d'erreur
                if (!validateDate($startdte)) {
                    $response_array['status'] = 'error';
                    $response_array['message'] = "Merci de choisir une date de prise de service valide";
                    echo json_encode($response_array);
                    exit();
                }
            } else {
                $response_array['status'] = 'error';
                $response_array['message'] = "Merci de choisir une date de prise de service";
                echo json_encode($response_array);
                exit();
            }
            if (!empty($_POST['enddte'])) {
                $enddte = $_POST['enddte'];
                // On verifie le format de date
                // S'il est incorrect on retourne un message d'erreur
                if (!validateDate($enddte)) {
                    $response_array['status'] = 'error';
                    $response_array['message'] = "Merci de choisir une date de fin de service valide";
                    echo json_encode($response_array);
                    exit();
                }
            } else {
                $response_array['status'] = 'error';
                $response_array['message'] = "Merci de choisir une date de fin de service";
                echo json_encode($response_array);
                exit();
            }
        } catch (Exception $e) {
            $response_array['status'] = 'error';
            $response_array['message'] = $e->getMessage();
            echo json_encode($response_array);
            exit();
        }
        // On met a jour la table rh_candidature avec le nouveau statut et les observations
        try {
            $update = $bdd->prepare("UPDATE rh_candidature SET statut=:statut, observations=:observations WHERE id=:id");
            $update->bindValue(':id', htmlspecialchars($_POST['idcandidat']), PDO::PARAM_INT);
            $update->bindValue(':statut', "Accept?? apr??s entretien", PDO::PARAM_STR);
            $update->bindValue(':observations', $observations, PDO::PARAM_STR);
            $update->execute();
        } catch (Exception $e) {
            $response_array['status'] = 'error';
            $response_array['message'] = $e->getMessage();
            echo json_encode($response_array);
            exit();
        }

        // On recupere la candidature qu'on vient de mettre a jour
        try {
            $update = $bdd->prepare("SELECT * FROM rh_candidature WHERE id=:id");
            $update->bindValue(':id', htmlspecialchars($_POST['idcandidat']), PDO::PARAM_INT);
            $update->execute();
            $candidature = $update->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $response_array['status'] = 'error';
            $response_array['message'] = $e->getMessage();
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
        } catch (PDOException $exception) {
            $response_array['status'] = 'error';
            $response_array['message'] = $e->getMessage();
            echo json_encode($response_array);
            exit();
        }

        // On cree un nouvel employe a partir de la candidature mise a jour
        try {
            $update = $bdd->prepare('INSERT INTO membres(nom, prenom, email, tel, dtenaissance, pays, langue, img_membres, name_entreprise, status_membres, role_membres, dtecontrat, missions, startdte, enddte, id_session) VALUES (?,?,?,?,?,?,?,?,(SELECT nameentreprise FROM entreprise WHERE id = ?),?,?,?,?,?,?,?)');
            $update->execute(array(
                htmlspecialchars($candidature['nom_candidat']),
                htmlspecialchars($candidature['prenom_candidat']),
                htmlspecialchars($candidature['email_candidat']),
                htmlspecialchars($candidature['tel_candidat']),
                htmlspecialchars($candidature['dtenaissance_candidat']),
                htmlspecialchars($candidature['pays']),
                htmlspecialchars($candidature['langue']),
                "astro2.gif",
                htmlspecialchars($_SESSION['id_session']),
                "Active",
                $annonce['poste'],
                $dtecontrat,
                $missions,
                $startdte,
                $enddte,
                htmlspecialchars($_SESSION['id_session'])
            ));
        } catch (Exception $e) {
            $response_array['status'] = 'error';
            $response_array['message'] = $e->getMessage();
            echo json_encode($response_array);
            exit();
        }

        $pdoS = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
        $pdoS->bindValue(':numentreprise', $_SESSION['id_session']);
        $true = $pdoS->execute();
        $entreprise = $pdoS->fetch();

        $message = "Bonjour " . $candidature['nom_candidat'] . " " . $candidature['prenom_candidat'] . ",\n\n" .
            "Suite ?? votre entretien pour le poste de " . $annonce['poste'] . " chez " . $entreprise['nameentreprise'] . ", j'ai le plaisir de vous annoncer que votre candidature a ??t?? retenu.\n\n" .
            "Vous ??tes invit?? dans nos locaux le $dtecontrat pour la signature de la convention de stage et vous d??marrez le $startdte.\n\n" .
            "Bien Cordialement\n\n" .
            "Service des Ressources Humaines.\n\n" .
            "Envoy?? par Coqpix.";

        $sujet = 'Votre candidature pour le poste de' . $annonce['poste'] . 'au sein de ' . $entreprise['nameentreprise'] . ".";

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
            $message = "Vous venez d'embaucher le candidat " . $candidature['nom_candidat'] . " " . $candidature['prenom_candidat'] . " apr??s un entretien pour le poste de " . $annonce['poste'] . ".\n\n" .
                "Vous l'avez aussi conviez ?? la signature de sa convention de stage qui aura lieu le $dtecontrat. La prise de service aura lieu le $startdte.\n\n" .
                "Bien Cordialement.\n\n" .
                "Service des Ressources Humaines.\n\n" .
                "Envoy?? par Coqpix.";

            $sujet = "Votre r??ponse ?? " . $candidature['nom_candidat'] . " " . $candidature['prenom_candidat'] . " pour sa candidature pour le poste de " . $annonce['poste'] . " au sein de votre entreprise.";

            $mail = [
                'nom_recepteur' => $entreprise['nameentreprise'],
                'adresse_recepteur' => $entreprise['emailentreprise'],
                'nom_emetteur' => "Service des ressources humaines",
                'adresse_emetteur' => "rh-noreply@" . $_SERVER['SERVER_NAME'],
                'sujet' => $sujet,
                'message' => $message
            ];

            $sent = email($mail);
            // On retourne un code de success
            $response_array['status'] = 'success';
            $response_array['link'] = 'rh-entretient-candidats.php';
            echo json_encode($response_array);
        } else {
            $response_array['status'] = 'error';
            echo json_encode($response_array);
        }
    }
}
exit();
