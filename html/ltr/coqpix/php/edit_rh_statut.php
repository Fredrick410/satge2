<?php
require_once 'verif_session_connect.php';
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
include 'mail.php';

$id = $_SESSION['candidat'];
if ($_SESSION['candidat'] == $_GET['num']) {
    if (isset($_GET['type'])) {
        $type = array("Admis à entretien", "Refusé avant entretien");
        if (in_array($_GET['type'], $type)) {
            try {
                $update = $bdd->prepare("UPDATE rh_candidature SET statut=:statut WHERE id=:id");
                $update->bindValue(':id', $_GET['num'], PDO::PARAM_INT);
                $update->bindValue(':statut', $_GET['type']);
                $update->execute();
            } catch (PDOException $exception) {
                var_dump($exception->getMessage());
            }
            try {
                $pdoStt = $bdd->prepare('SELECT * FROM rh_candidature WHERE id = :num');
                $pdoStt->bindValue(':num', $_GET['num'], PDO::PARAM_INT);
                $pdoStt->execute();
                $candidature = $pdoStt->fetch();
            } catch (PDOException $exception) {
                var_dump($exception->getMessage());
            }
            $explode = explode(';', $candidature['key_candidat']);
            $num = $explode[2];
            try {
                $pdoSta = $bdd->prepare('SELECT * FROM rh_annonce WHERE id=:num');
                $pdoSta->bindValue(':num', $num);
                $pdoSta->execute();
                $annonce = $pdoSta->fetch();
            } catch (PDOException $exception) {
                var_dump($exception->getMessage());
            }

            $pdoS = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
            $pdoS->bindValue(':numentreprise', $_SESSION['id_session']);
            $true = $pdoS->execute();
            $entreprise = $pdoS->fetch();

            if ($candidature['statut'] == "Admis à entretien") {
                $message = "Bonjour " . $candidature['nom_candidat'] . " " . $candidature['prenom_candidat'] . ",\n\n" .
                    "Suite à votre candidature pour le poste de " . $annonce['poste'] . ", j'ai le plaisir de vous proposer un entretien.\n\n" .
                    "Merci de me confirmer vos disponibilités a cette adresse: ". $entreprise['emailentreprise'].".\n\n" .
                    "Bien Cordialement.\n\n" .
                    "Service des Ressources Humaines.\n\n" .
                    $entreprise['nameentreprise'].".\n\n" .
                    "Envoyé par Coqpix.";
            } else if ($candidature['statut'] == "Refusé avant entretien") {
                $message = "Bonjour " . $candidature['nom_candidat'] . " " . $candidature['prenom_candidat'] . ",\n\n" .
                    "Merci d'avoir candidaté au poste de " . $annonce['poste'] . " chez " . $entreprise['nameentreprise'] . ".\n\n" .
                    "Nous avons attentivement étudié votre profil mais nous ne pouvons malheureusement pas donner suite.\n\n" .
                    "Nous vous remercions du temps investi pour postuler chez " . $entreprise['nameentreprise'] . " et vous encourageons à poursuivre vos candidatures.\n\n" .
                    "Bonne chance pour votre recherche d'emploi.\n\n" .
                    "Merci encore pour l'intérêt que vous avez porté à notre entreprise.\n\n" .
                    "Bien Cordialement.\n\n" .
                    "Service des Ressources Humaines.\n\n" .
                    $entreprise['nameentreprise'].".\n\n" .
                    "Envoyé par Coqpix.";
            }

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
                if ($candidature['statut'] == "Admis à entretien") {
                    $message = "Vous venez d'admettre le candidat " . $candidature['nom_candidat'] . " " . $candidature['prenom_candidat'] . " à un entretien pour le poste de " . $annonce['poste'] . ".\n\n" .
                        "Merci de discuter des modalités de cet entretien avec le candidat puis créer un entretien dans l'espace entretien.\n\n" .
                        "Bien Cordialement.\n\n" .
                        "Service des Ressources Humaines.\n\n" .
                        "Envoyé par Coqpix.";
                } else if ($candidature['statut'] == "Refusé avant entretien") {
                    $message = "Vous venez de refuser le candidat " . $candidature['nom_candidat'] . " " . $candidature['prenom_candidat'] . " avant un entretien pour le poste de " . $annonce['poste'] . ".\n\n" .
                        "Bien Cordialement.\n\n" .
                        "Service des Ressources Humaines.\n\n" .
                        "Envoyé par Coqpix.";
                }

                $sujet = "Votre réponse à " . $candidature['nom_candidat'] . " " . $candidature['prenom_candidat'] . " pour sa candidature pour le poste de " . $annonce['poste'] . " au sein de votre entreprise.";

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
    }
}
header("Location: ../rh-recrutement-view.php?num=$id");
exit();
