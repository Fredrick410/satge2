<?php
session_start();
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
include('mail.php');
if (isset($_POST['confirm']) and $_POST['confirm'] === 'confirm') {
    $key = htmlspecialchars($_POST['key']);
    if ($key === $_SESSION['key_candidat']) {
        try {
            $pdoStt = $bdd->prepare('SELECT * FROM rh_candidature WHERE key_candidat = :num');
            $pdoStt->bindValue(':num', $key, PDO::PARAM_STR);
            $pdoStt->execute();
            $candidature = $pdoStt->fetch();
        } catch (PDOException $e) {
            $_SESSION['message'] = $e->GetMessage();
            header("Location: candidature-recrutement-files.php?key=$key");
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
            $_SESSION['message'] = $e->GetMessage();
            header("Location: candidature-recrutement-files.php?key=$key");
            exit();
        }

        $num = $explode[1];

        $pdoS = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
        $pdoS->bindValue(':numentreprise', $num);
        $true = $pdoS->execute();
        $entreprise = $pdoS->fetch();
        $url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        $message = "Bonjour " . $candidature['nom_candidat'] . " " . $candidature['prenom_candidat'] . ",\n\n" .
            "Vous venez de valider votre dépot de document. La prochaine etape est la réalisation du test prévu pour ce poste.\n\n" .
            "Merci d'utiliser le lien suivant pour acceder au test: <a href=\"" . str_replace("php/valider_documents.php", "test-qcm.php?key=$key", $url) . "\">Test qcm</a> .\n\n" .
            "Il est aussi disponible dans le cas ou vous souhaitez le faire plus tard et sera invalide dès la finalisation de votre candidature.\n\n" .
            "A bientôt !\n\n" .
            "Service des Ressources Humaines.\n\n" .
            "Envoyé par Coqpix.";

        $sujet = 'Votre candidature pour le poste de ' . $annonce['poste'] . ' au sein de ' . $entreprise['nameentreprise'] . ".";

        $mail = [
            'nom_recepteur' => $candidature['nom_candidat'] . " " . $candidature['prenom_candidat'],
            'adresse_recepteur' => $candidature['email_candidat'],
            'nom_emetteur' => "Service des ressources humaines",
            'adresse_emetteur' => "rh@". $_SERVER['SERVER_NAME'],
            'sujet' => $sujet,
            'message' => $message
        ];

        echo $mail['adresse_emetteur'];
        $sent = email($mail);
        if ($sent) {
            header("Location: ../test-qcm.php?key=$key");
        } else {
            $_SESSION['message'] = "Erreur";
            header("Location: ../candidature-recrutement-files.php?key=$key");
            exit();
        }
    } else {
        $key = $_SESSION['key_candidat'];
        header("Location: ../candidature-recrutement-files.php?key=$key");
        exit();
    }
}
