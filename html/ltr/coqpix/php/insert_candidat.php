<?php
session_start();
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
include 'mail.php';

$num = $_GET['num'];
if (!empty($_POST['name_annonce'])) {
    $name_annonce = htmlspecialchars($_POST['name_annonce']);
} else {
    $_SESSION['message'] = "Merci de ne pas toucher au nom de l'annonce";
    header("Location: ../candidature-recrutement.php?num=$num");
    exit();
}
if (!empty($_POST['nom_candidat'])) {
    $nom_candidat = htmlspecialchars($_POST['nom_candidat']);
} else {
    $_SESSION['message'] = "Merci de saisir un nom";
    header("Location: ../candidature-recrutement.php?num=$num");
    exit();
}
if (!empty($_POST['prenom_candidat'])) {
    $prenom_candidat = htmlspecialchars($_POST['prenom_candidat']);
} else {
    $_SESSION['message'] = "Merci de saisir un prénom";
    header("Location: ../candidature-recrutement.php?num=$num");
    exit();
}
if (!empty($_POST['sexe_candidat'])) {
    $sexe_candidat = htmlspecialchars($_POST['sexe_candidat']);
} else {
    $_SESSION['message'] = "Merci de choisir un sexe";
    header("Location: ../candidature-recrutement.php?num=$num");
    exit();
}
if (!empty($_POST['age_candidat'])) {
    $age_candidat = htmlspecialchars($_POST['age_candidat']);
} else {
    $_SESSION['message'] = "Merci de saisir un age";
    header("Location: ../candidature-recrutement.php?num=$num");
    exit();
}
if (!empty($_POST['specialite_candidat'])) {
    $specialite_candidat = htmlspecialchars($_POST['specialite_candidat']);
} else {
    $_SESSION['message'] = "Merci de saisir au moins une spécialité";
    header("Location: ../candidature-recrutement.php?num=$num");
    exit();
}
$image_candidat = "";
if (!empty($_POST['time_candidat'])) {
    $time_candidat = htmlspecialchars($_POST['time_candidat']);
} else {
    $_SESSION['message'] = "Merci de ne pas modifier la durée";
    header("Location: ../candidature-recrutement.php?num=$num");
    exit();
}
$logiciel = $_POST['logiciel'];
if (!empty($_POST['langue'])) {
    $langue = htmlspecialchars($_POST['langue']);
} else {
    $_SESSION['message'] = "Merci d'entrer au moins une langue";
    header("Location: ../candidature-recrutement.php?num=$num");
    exit();
}
$formationetude = $_POST['formationetude'];
$interet = $_POST['interet'];
$qualite = $_POST['qualite'];
$default = $_POST['default'];
$permis_conduite = implode(", ", $_POST['permis_conduite']);
if (!empty($_POST['tel_candidat'])) {
    $tel_candidat = htmlspecialchars($_POST['tel_candidat']);
} else {
    $_SESSION['message'] = "Merci d'entrer un numéro de téléphone";
    header("Location: ../candidature-recrutement.php?num=$num");
    exit();
}
if (!empty($_POST['email_candidat'])) {
    $email_candidat = htmlspecialchars($_POST['email_candidat']);
} else {
    $_SESSION['message'] = "Merci d'entrer une adresse mail";
    header("Location: ../candidature-recrutement.php?num=$num");
    exit();
}
if (!empty($_POST['dtenaissance_candidat'])) {
    $dtenaissance_candidat = htmlspecialchars($_POST['dtenaissance_candidat']);
} else {
    $_SESSION['message'] = "Merci d'entrer votre date de naissance";
    header("Location: ../candidature-recrutement.php?num=$num");
    exit();
}
if (!empty($_POST['pays'])) {
    $pays = htmlspecialchars($_POST['pays']);
} else {
    $_SESSION['message'] = "Merci d'entrer votre pays actuel de résidence";
    header("Location: ../candidature-recrutement.php?num=$num");
    exit();
}


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

//echo $max_upload = (int)(ini_get('upload_max_filesize'));

$id_session = $_POST['id_session'];

$pdoSta = $bdd->prepare('SELECT * FROM rh_annonce WHERE id=:num');
$pdoSta->bindValue(':num', $num);
$pdoSta->execute();
$annonce = $pdoSta->fetch();

if (isset($_FILES['i_candidat']) and !empty($_FILES['i_candidat']['name'])) {

    if ($_FILES['i_candidat']['error'] > 0) {

        echo "Une erreur est survenue lors du téléchargement de l'image";
        die();
    }

    // On recupère le chemin
    $dossier = '../../../../src/img/';
    $fichier = basename($_FILES['i_candidat']['name']);
    $real_name = substr($fichier, 0, -4);
    $file_type = strtolower(pathinfo($fichier, PATHINFO_EXTENSION));
    $final_path = $dossier . $real_name . "." . $file_type;
    $resultat = $real_name . "." . $file_type;
    if (!move_uploaded_file($_FILES['i_candidat']['tmp_name'], $final_path)) //Si la fonction renvoie FALSE, c'est que ça n'a pas fonctionné...
    {
        $_SESSION['message'] = "Echec de l'upload";
        header("Location: ../candidature-recrutement.php?num=$num");
        exit();
    }
} else if ($annonce['image'] == 'oui') {
    $_SESSION['message'] = "L'insertion de l'image est obligatoire";
    header("Location: ../candidature-recrutement.php?num=$num");
    exit();
}


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
    htmlspecialchars($resultat),
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

$_SESSION['key_candidat'] = $code;

$pdoS = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
$pdoS->bindValue(':numentreprise', $id_session);
$true = $pdoS->execute();
$entreprise = $pdoS->fetch();

try {
    $pdoStt = $bdd->prepare('SELECT * FROM rh_candidature WHERE key_candidat = :num');
    $pdoStt->bindValue(':num', $code, PDO::PARAM_STR);
    $pdoStt->execute();
    $candidature = $pdoStt->fetch();
} catch (PDOException $e) {
    $_SESSION['message'] = $e->GetMessage();
    header("Location: ../candidature-recrutement.php?num=$num");
    exit();
}

$url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

$url = str_replace("php/insert_candidat.php?num=$num", "candidature-recrutement-files.php?key=$code", $url);

$message = "Bonjour " . $candidature['nom_candidat'] . " " . $candidature['prenom_candidat'] . ",\n\n" .
    "Vous venez de valider votre dépôt de vos information personnel et des conpetence. La prochaine etape est le dépôt des document pour ce poste à savoir le CV et les lettre de motivation.\n\n" .
    "Merci d'utiliser le lien suivant pour accéder à la rubrique document: <a href=\"$url\">$url</a> .\n\n" .
    "Il est aussi disponible dans le cas ou vous souhaitez le faire plus tard et sera indisponible dès la finalisation de votre candidature.\n\n" .
    "A bientôt !\n\n" .
    "Service des Ressources Humaines.\n\n" .
    "Envoyé par Coqpix.";

$sujet = 'Votre candidature pour le poste de ' . $annonce['poste'] . ' au sein de ' . $entreprise['nameentreprise'] . ".";

$mail = [
    'nom_recepteur' => $candidature['nom_candidat'] . " " . $candidature['prenom_candidat'],
    'adresse_recepteur' => $candidature['email_candidat'],
    'nom_emetteur' => "Service des ressources humaines",
    'adresse_emetteur' => "rh-noreply@" . $_SERVER['SERVER_NAME'],
    'sujet' => $sujet,
    'message' => $message
];

$sent = email($mail);
if ($sent) {
    header("Location: ../candidature-recrutement-files.php?key=$code");
} else {
    $_SESSION['message'] = "Erreur";
    header("Location: ../candidature-recrutement.php?num=$num");
}
exit();