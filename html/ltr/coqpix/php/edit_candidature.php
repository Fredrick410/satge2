<?php
require_once 'verif_session_connect.php';
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

function filter(&$value)
{
    $value = htmlspecialchars($value, ENT_HTML5, 'UTF-8');
}

// On verifie l'existance des parametres
if (isset($_POST['idcandidat']) and isset($_POST['observations']) and isset($_POST['missions'])) {
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
            $missions = "";
        }
    } catch (Exception $e) {
        $response_array['status'] = 'error';
        $response_array['message'] = $e->getMessage();
        echo json_encode($response_array);
        exit();
    }
    // On met a jour la table rh_candidature avec le nouveau statut et les observations
    try {
        $update = $bdd->prepare("UPDATE rh_candidature SET missions=:missions, observations=:observations WHERE id=:id");
        $update->bindValue(':id', htmlspecialchars($_POST['idcandidat']), PDO::PARAM_INT);
        $update->bindValue(':observations', $observations, PDO::PARAM_STR);
        $update->bindValue(':missions', $missions, PDO::PARAM_STR);
        $update->execute();
    } catch (Exception $e) {
        $response_array['status'] = 'error';
        $response_array['message'] = $e->getMessage();
        echo json_encode($response_array);
        exit();
    }
}
// On retourne un code de success
$response_array['status'] = 'success';
$response_array['link'] = 'rh-entretient-candidats.php';
echo json_encode($response_array);
exit();
