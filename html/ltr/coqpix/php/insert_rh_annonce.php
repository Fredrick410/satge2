<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
$authorised_roles = array('admin', 'rh');
require_once 'php/verif_session_connect.php';

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
    return substr(str_shuffle(
        'abcdefghijklmnopqrstuvwxyzABCEFGHIJKLMNOPQRSTUVWXYZ0123456789("$^^ù!:;,'
    ), 1, $nbChar);
}

// On verifie si les parametres sont non vides
// Si oui, on retourne un message d'erreur
if (!empty($_POST['name_annonce'])) {
    $name_annonce = $_POST['name_annonce'];
} else {
    $response_array['status'] = 'error';
    $response_array['message'] = 'Merci de nommer l\'annonce.';
    echo json_encode($response_array);
    exit();
}
if (!empty($_POST['description_annonce'])) {
    $description_annonce = $_POST['description_annonce'];
} else {
    $response_array['status'] = 'error';
    $response_array['message'] = 'Merci de décrire l\'annonce.';
    echo json_encode($response_array);
    exit();
}
if (!empty($_POST['email_annonce'])) {
    $email_annonce = $_POST['email_annonce'];
} else {
    $response_array['status'] = 'error';
    $response_array['message'] = 'Merci de donner l\'email de contact.';
    echo json_encode($response_array);
    exit();
}
if (!empty($_POST['tel_annonce'])) {
    $tel_annonce = $_POST['tel_annonce'];
} else {
    $response_array['status'] = 'error';
    $response_array['message'] = 'Merci de donner le numéro de contact.';
    echo json_encode($response_array);
    exit();
}

if (!empty($_POST['age_annonce'])) {
    $age_annonce = $_POST['age_annonce'];
} else {
    $response_array['status'] = 'error';
    $response_array['message'] = 'Merci de donner l\'age requis pour candidater.';
    echo json_encode($response_array);
    exit();
}

if (!empty($_POST['poste_annonce'])) {
    $poste_annonce = $_POST['poste_annonce'];
} else {
    $response_array['status'] = 'error';
    $response_array['message'] = 'Merci de donner le poste a pourvoir.';
    echo json_encode($response_array);
    exit();
}


if (!empty($_POST['niveau_annonce'])) {
    $niveau_annonce = $_POST['niveau_annonce'];
} else {
    $response_array['status'] = 'error';
    $response_array['message'] = 'Merci de donner le niveau requis pour candidater.';
    echo json_encode($response_array);
    exit();
}

if (!empty($_POST['pays_annonce'])) {
    $pays_annonce = $_POST['pays_annonce'];
} else {
    $response_array['status'] = 'error';
    $response_array['message'] = 'Merci de donner le pays de l\'annonce.';
    echo json_encode($response_array);
    exit();
}
if (!empty($_POST['type_contrat'])) {
    $type_contrat = implode(", ", $_POST['type_contrat']);
} else {
    $response_array['status'] = 'error';
    $response_array['message'] = "Merci de choisir les types de contrats de l'offre";
    echo json_encode($response_array);
    exit();
}

if (!empty($_POST['image'])) {
    $image = $_POST['image'];
} else {
    $response_array['status'] = 'error';
    $response_array['message'] = 'Merci de donner de dire si l\'image est obligatoire.';
    echo json_encode($response_array);
    exit();
}

$img_annonce = "";

// On retourne un message d'erreur si les champs dates ne sont pas numeriques
if (!is_numeric($_POST['date_y']) or !is_numeric($_POST['date_m']) or !is_numeric($_POST['date_d'])) {
    $response_array['status'] = 'error';
    $response_array['message'] = 'Merci de donner une durée de service valide.';
    echo json_encode($response_array);
    exit();
}
// On retourne un message d'erreur si les champs dates sont tous a 0
if ($_POST['date_y'] == 0 and $_POST['date_m'] == 0 and $_POST['date_d'] == 0) {
    $response_array['status'] = 'error';
    $response_array['message'] = 'Merci de donner une durée de service valide.';
    echo json_encode($response_array);
    exit();
} else {
    if ($_POST['date_y'] == "0") {
        $date_y = "";
    } else {
        $date_y = $_POST['date_y'] . ' ans,';
    }

    if ($_POST['date_m'] == "0") {
        $date_m = "";
    } else {
        $date_m = $_POST['date_m'] . ' mois,';
    }

    if ($_POST['date_d'] == "0") {
        $date_d = "";
    } else {
        $date_d = '' . $_POST['date_d'] . ' jours';
    }
}

$temps_annonce = '' . $date_y . '' . $date_m . '' . $date_d . '';

$color_annonce = $_POST['color_annonce'];
$statut = "pause";

// On insere l'annonce si au moins un qcm et une mission sont presents
// Sinon on retourne une erreur
if (!empty($_POST['qcms']) and !empty($_POST['missions'])) {
    try {
        $missions = $_POST['missions'];
        $qcms = $_POST['qcms'];
        $insert = $bdd->prepare('INSERT INTO rh_annonce (name_annonce, description_annonce, img_annonce, email_annonce, tel_annonce, age, poste, niveau, pays, temps, color_annonce, statut, id_session, qcm, link, type_contrat, image) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,"","",?,?)');
        $insert->execute(array(
            htmlspecialchars($name_annonce),
            htmlspecialchars($description_annonce),
            htmlspecialchars($img_annonce),
            htmlspecialchars($email_annonce),
            htmlspecialchars($tel_annonce),
            htmlspecialchars($age_annonce),
            htmlspecialchars($poste_annonce),
            htmlspecialchars($niveau_annonce),
            htmlspecialchars($pays_annonce),
            htmlspecialchars($temps_annonce),
            htmlspecialchars($color_annonce),
            htmlspecialchars($statut),
            htmlspecialchars($_SESSION['id_session']),
            htmlspecialchars($type_contrat),
            htmlspecialchars($image)
        ));

        $id_annonce = $bdd->lastInsertId();

        // On associe les qcms et l'annonce
        foreach ($qcms as $key => $value) {
            $insert = $bdd->prepare('INSERT INTO rh_annonce_qcm VALUES(?,?)');
            $insert->execute(array(
                htmlspecialchars($id_annonce),
                htmlspecialchars($value)
            ));
        }

        // On insere les missions et on les associe a l'annonce
        foreach ($missions as $key => $value) {
            $pdo = $bdd->prepare('INSERT INTO fiche_poste(libelle, acquis, idannonce) VALUES (:libelle, :acquis, :idannonce)');
            $pdo->bindValue(':libelle', htmlspecialchars($value));
            $pdo->bindValue(':acquis', "");
            $pdo->bindValue(':idannonce', htmlspecialchars($id_annonce));
            $pdo->execute();
        }

        $link_annonce = "num=" . $id_annonce;

        // On met a jour le lien de l'annonce
        $pdo = $bdd->prepare('UPDATE rh_annonce SET link=:link WHERE id=:id LIMIT 1');
        $pdo->bindValue(':link', $link_annonce);
        $pdo->bindValue(':id', $id_annonce);
        $pdo->execute();
    } catch (Exception $e) {
        $response_array['status'] = $e->getMessage();
        $response_array['message'] = 'Merci de choisir au moins un qcm.';
    }
    $response_array['status'] = 'success';
    $response_array['link'] = 'rh-recrutement.php';
} else {
    $response_array['status'] = 'error';
    $response_array['message'] = 'Merci de choisir au moins un qcm.';
}
header('Content-type: application/json');
echo json_encode($response_array);
