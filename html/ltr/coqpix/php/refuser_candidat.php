<?php
require_once 'verif_session_connect.php';
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
include 'mail.php';

// On verifie l'existance des parametres
if (isset($_POST['refuse']) and isset($_POST['idcandidat']) and isset($_POST['observations'])) {
    if ($_POST['refuse'] == "refuse") {
        // On verifie si les parametres sont non vides
        // Si oui, on retourne un message d'erreur
        if (!empty($_POST['observations'])) {
            $observations = htmlspecialchars($_POST['observations']);
        } else {
            $response_array['status'] = 'error';
            $response_array['message'] = "Merci de mettre une observation";
            echo json_encode($response_array);
            exit();
        }
        // On met a jour la table rh_candidature avec le nouveau statut et les observations
        try {
            $update = $bdd->prepare("UPDATE rh_candidature SET statut=:statut, observations=:observations WHERE id=:id");
            $update->bindValue(':id', htmlspecialchars($_POST['idcandidat']), PDO::PARAM_INT);
            $update->bindValue(':statut', "Refusé après entretien", PDO::PARAM_STR);
            $update->bindValue(':observations', $observations, PDO::PARAM_STR);
            $update->execute();
        } catch (Exception $e) {
            $response_array['status'] = 'error';
            $response_array['message'] = $e->getMessage();
            echo json_encode($response_array);
            exit();
        }
        try {
            $pdoStt = $bdd->prepare('SELECT * FROM rh_candidature WHERE id = :num');
            $pdoStt->bindValue(':num', htmlspecialchars($_POST['idcandidat']), PDO::PARAM_INT);
            $pdoStt->execute();
            $candidature = $pdoStt->fetch();
        } catch (PDOException $e) {
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
        } catch (PDOException $e) {
            $response_array['status'] = 'error';
            $response_array['message'] = $e->getMessage();
            echo json_encode($response_array);
            exit();
        }

        $pdoS = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
        $pdoS->bindValue(':numentreprise', $_SESSION['id_session']);
        $true = $pdoS->execute();
        $entreprise = $pdoS->fetch();

        if ($candidature['statut'] == "Refusé après entretien") {
            $message = "Bonjour " . $candidature['nom_candidat'] . " " . $candidature['prenom_candidat'] . ",\n\n".
            "Suite à votre entretien pour le poste de " . $annonce['poste'] . " chez " . $entreprise['nameentreprise'] . ".\n\n".
            "Nous avons attentivement traité votre candidature, mais nous ne pouvons malheureusement pas donner suite.\n\n".
            "Nous vous remercions du temps investi pour postuler chez " . $entreprise['nameentreprise'] . " et vous encourageons à poursuivre vos candidatures.\n\n".
            "Bonne chance pour votre recherche d'emploi.\n\n".
            "Merci encore pour l'intérêt que vous avez porté à notre entreprise.\n\n".
            "Bien Cordialement,\n\n".
            "Service des Ressources Humaines.\n\n".
            "Envoyé par Coqpix.";
        }

        $sujet = 'Votre candidature pour le poste de' . $annonce['poste'] . 'au sein de ' . $entreprise['nameentreprise'] . ".";

        $mail = [
            'nom_recepteur' => $candidature['nom_candidat'] . " " . $candidature['prenom_candidat'],
            'adresse_recepteur' => $candidature['email_candidat'],
            'nom_emetteur' => "Service des ressources humaines",
            'adresse_emetteur' => $entreprise['emailentreprise'],
            'sujet' => $sujet,
            'message' => $message
        ];

        email($mail);
    }
}
// On retourne un code de success
$response_array['status'] = 'success';
$response_array['link'] = 'rh-entretient-candidats.php';
echo json_encode($response_array);
exit();
