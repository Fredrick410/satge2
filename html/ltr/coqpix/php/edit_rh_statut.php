<?php
require_once 'verif_session_connect.php';
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$id = $_SESSION['candidat'];
if ($_SESSION['candidat'] == $_GET['num']) {
    if (isset($_GET['type'])) {
        $type = array("success", "failure");
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

            if ($candidature['statut'] == "success") {
                $message = "Bonjour " . $candidature['nom_candidat'] . " " . $candidature['prenom_candidat'] . ",\r\n
                Suite à votre candidature pour le poste de " . $annonce['poste'] . ", j'ai le plaisir de vous proposer un entretien en visio d'1/2 heure.\r\n
                Merci de me confirmer votre disponibilité.\r\n
                Bien Cordialement\r\n
                        
                Le Service des Ressources Humaines.\r\n
                Coqpix.";
            } else if ($etape == "failure") {
                $message = "Bonjour $prenom $nom,\r\n
                Merci d'avoir candidaté au poste de " . $annonce['poste'] . " chez " . $entreprise['nameentreprise'] . ".\r\n
                Nous avons attentivement étudié votre profil mais nous ne pouvons malheureusement pas donner suite. Nous vous remercions du temps investi pour postuler chez " . $entreprise['nameentreprise'] . " et vous encourageons à poursuivre vos candidatures.\r\n
                Bonne chance pour votre recherche d'emploi.\r\n
                Merci encore pour l'intérêt que vous avez porté à notre entreprise.\r\n
                Bien Cordialement\r\n
                        
                La Service des Ressources Humaines.\r\n
                Coqpix.";
            }

            $sujet = 'Votre candidature pour le poste de' . $annonce['poste'] . 'au sein de ' . $entreprise['nameentreprise'] . ".";

            $mail = [
                'nom_recepteur' => $candidature['nom_candidat'] . " " . $candidature['prenom_candidat'],
                'adresse_recepteur' => $candidature['email_candidat'],
                'nom_emetteur' => "Service des ressources humaines",
                'adresse_emetteur' => "hr@coqpix.com",
                'sujet' => $sujet,
                'message' => $message
            ];
            
            email($mail);
        }
    }
}
header("Location: ../rh-recrutement-view.php?num=$id");
exit();
