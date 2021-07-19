<?php
session_start();
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
include('mail.php');

$name_annonce =  $_POST['name_annonce'];
$nom_candidat = $_POST['nom_candidat'];
$prenom_candidat = $_POST['prenom_candidat'];
$sexe_candidat = $_POST['sexe_candidat'];
$age_candidat = $_POST['age_candidat'];
$specialite_candidat = $_POST['specialite_candidat'];
$image_candidat = "";
$time_candidat = $_POST['time_candidat'];
$logiciel = $_POST['logiciel'];
$langue = $_POST['langue'];
$formationetude = $_POST['formationetude'];
$interet = $_POST['interet'];
$qualite = $_POST['qualite'];
$default = $_POST['default'];
$permis_conduite = $_POST['permis_conduite'];
$tel_candidat = $_POST['tel_candidat'];
$email_candidat = $_POST['email_candidat'];
$dtenaissance_candidat = $_POST['dtenaissance_candidat'];
$pays = $_POST['pays'];

$pdoS = $bdd->prepare('SELECT * FROM rh_candidature WHERE id_session = :num AND name_annonce=:name_annonce');
$pdoS->bindValue(':num', $_POST['id_session']);
$pdoS->bindValue(':name_annonce', $name_annonce);
$pdoS->execute();
$candidature_candidature = $pdoS->fetchAll();
$count_candidature = count($candidature_candidature);

$num_candidat = $count_candidature + 1;

if (strlen($num_candidat) == 1) {
    $num_candidat = '00' . $num_candidat . '';
} elseif (strlen($num_candidat) == 2) {
    $num_candidat = '0' . $num_candidat . '';
} else {
    $num_candidat = $num_candidat;
}

function passgen1($nbChar)
{
    $chaine = "mnoTUzS5678kVvwxy9WXYZRNCDEFrslq41GtuaHIJKpOPQA23LcdefghiBMbj0";
    srand((float)microtime() * 1000000);
    $pass = '';
    for ($i = 0; $i < $nbChar; $i++) {
        $pass .= $chaine[rand() % strlen($chaine)];
    }
    return $pass;
}

function passgen2($nbChar)
{
    return substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 1, $nbChar);
}

$id_session = $_POST['id_session'];
$num = $_GET['num'];

$code = '' . passgen1(10) . ';' . $id_session . ';' . $num . '';

$insert = $bdd->prepare('INSERT INTO rh_candidature (name_annonce , num_candidat, sexe_candidat, nom_candidat, prenom_candidat, age_candidat, tel_candidat, email_candidat, dtenaissance_candidat, pays, specialite_candidat, image_candidat, time_candidat, logiciel, langue, formationetude, interet, qualite, default_candi, cv_doc, lettredemotivation_doc, other_doc, qcm, statut, key_candidat, id_session,permis_conduite) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
$insert->execute(array(
    htmlspecialchars($name_annonce),
    htmlspecialchars($num_candidat),
    htmlspecialchars($sexe_candidat),
    htmlspecialchars($nom_candidat),
    htmlspecialchars($prenom_candidat),
    htmlspecialchars($age_candidat),
    htmlspecialchars($tel_candidat),
    htmlspecialchars($email_candidat),
    htmlspecialchars($dtenaissance_candidat),
    htmlspecialchars($pays),
    htmlspecialchars($specialite_candidat),
    htmlspecialchars(""),
    htmlspecialchars($time_candidat),
    htmlspecialchars($logiciel),
    htmlspecialchars($langue),
    htmlspecialchars($formationetude),
    htmlspecialchars($interet),
    htmlspecialchars($qualite),
    htmlspecialchars($default),
    htmlspecialchars(""),
    htmlspecialchars(""),
    htmlspecialchars(""),
    htmlspecialchars(""),
    htmlspecialchars("En cours"),
    htmlspecialchars($code),
    htmlspecialchars($id_session),
    htmlspecialchars($permis_conduite)
));

$pdoS = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
$pdoS->bindValue(':numentreprise', $id_session);
$true = $pdoS->execute();
$entreprise = $pdoS->fetch();

$explode = explode(';', $code);
$num = $explode[2];

$pdoSta = $bdd->prepare('SELECT * FROM rh_annonce WHERE id=:num');
$pdoSta->bindValue(':num', $num);
$pdoSta->execute();
$annonce = $pdoSta->fetch();

$sujet = 'Votre candidature pour le poste de ' . $annonce['poste'] . ' au sein de ' . $entreprise['nameentreprise'] . ".";

$message = "Bonjour $prenom_candidat $nom_candidat,\r\n
    Bravo pour ce premier pas et merci de l’intérêt que vous nous portez à " . $entreprise['nameentreprise'] . ".\r\n
    Votre candidature au poste de " . $annonce['poste'] . " leur a bien été transmise.\r\n
    L'équipe de recrutement va l’étudier avec beaucoup d’attention. Nous ne manquerons pas de vous contacter rapidement si votre profil correspond à leurs attentes.\r\n
    A bientôt !\r\n
    La Direction des Ressources Humaines.\r\n
    Coqpix.";

$mail = [
    'nom_recepteur' => $nom_candidat . " " . $prenom_candidat,
    'adresse_recepteur' => $email_candidat,
    'nom_emetteur' => "Service des ressources humaines",
    'adresse_emetteur' => "hr@coqpix.com",
    'sujet' => $sujet,
    'message' => $message
];

email($mail);

header('Location: ../test-qcm.php?key=' . $code . '');
exit();
