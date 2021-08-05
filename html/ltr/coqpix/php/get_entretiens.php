<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
require_once 'php/verif_session_connect.php';

// On verifie l'existance du parametre
if (isset($_POST['id_candidature']) and !empty($_POST['id_candidature'])) {
    // On recupere la liste des entretiens du candidat
    try {
        $update = $bdd->prepare("SELECT * FROM entretien WHERE id_candidature=:id");
        $update->bindValue(':id', htmlspecialchars($_POST['id_candidature']), PDO::PARAM_INT);
        $update->execute();
        $entretiens = $update->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $response_array['status'] = 'error';
        $response_array['message'] = $e->getMessage();
        echo json_encode($response_array);
        exit();
    }
}
else{
    // On recupere la liste des entretiens du candidat
    try {
        $update = $bdd->prepare("SELECT * FROM entretien");
        $update->execute();
        $entretiens = $update->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $response_array['status'] = 'error';
        $response_array['message'] = $e->getMessage();
        echo json_encode($response_array);
        exit();
    }
}
// On retourne un code de succes
$response_array['status'] = 'success';
$response_array['link'] = 'rh-entretient-candidats.php';
$response_array['entretiens'] = $entretiens;
echo json_encode($response_array);
exit();
