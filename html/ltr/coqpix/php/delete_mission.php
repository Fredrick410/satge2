<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';
require_once 'verif_session_connect.php';

// On verifie l'existance des parametres
if (isset($_POST['id_mission'])) {
    // On verifie si les parametres sont non vides
    // Si oui, on retourne un message d'erreur
    try {
        if (!empty($_POST['id_mission'])) {
            $id_mission = htmlspecialchars($_POST['id_mission']);
        } else {
            $response_array['status'] = 'error';
            $response_array['message'] = "Identifiant de mission vide";
            echo json_encode($response_array);
            exit();
        }
    } catch (Exception $e) {
        $response_array['status'] = 'error';
        $response_array['message'] = $e->getMessage();
        echo json_encode($response_array);
        exit();
    }

    // On recherche la mission
    try {
        $pdo = $bdd->prepare('DELETE FROM mission WHERE id = :id');
        $pdo->bindValue(':id', $id_mission);
        $pdo->execute();
    } catch (Exception $e) {
        $response_array['status'] = 'error';
        $response_array['message'] = $e->getMessage();
        echo json_encode($response_array);
        exit();
    }

    // On recherche la mission
    try {
        $pdo = $bdd->prepare('DELETE FROM task WHERE id_mission = :id');
        $pdo->bindValue(':id', $id_mission);
        $pdo->execute();
    } catch (Exception $e) {
        $response_array['status'] = 'error';
        $response_array['message'] = $e->getMessage();
        echo json_encode($response_array);
        exit();
    }
}
// On retourne un code de success
$response_array['status'] = 'success';
echo json_encode($response_array);
exit();
