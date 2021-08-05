<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';
require_once 'verif_session_connect.php';

// On verifie l'existance des parametres
if (isset($_POST['name_mission']) and isset($_POST['id_mission'])) {
    // On verifie si les parametres sont non vides
    // Si oui, on retourne un message d'erreur
    try {
        if (!empty($_POST['name_mission'])) {
            $name_mission = htmlspecialchars($_POST['name_mission']);
        } else {
            $response_array['status'] = 'error';
            $response_array['message'] = "Titre vide";
            echo json_encode($response_array);
            exit();
        }
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
        $pdo = $bdd->prepare('SELECT * FROM mission WHERE id = :id');
        $pdo->bindValue(':id', $id_mission);
        $pdo->execute();
        $mission = $pdo->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $response_array['status'] = 'error';
        $response_array['message'] = $e->getMessage();
        echo json_encode($response_array);
        exit();
    }
    if (!isset($mission) or empty($mission)) {
        try {
            $pdo = $bdd->prepare('INSERT INTO mission(name_mission, id_session) VALUES (:name_mission,:id_session)');
            $pdo->bindValue(':name_mission', $name_mission);
            $pdo->bindValue(':id_session', $_SESSION['id_session']);
            $pdo->execute();
        } catch (Exception $e) {
            $response_array['status'] = 'error';
            $response_array['message'] = $e->getMessage();
            echo json_encode($response_array);
            exit();
        }
    } else {
        try {
            $pdo = $bdd->prepare('UPDATE mission SET name_mission = :name_mission WHERE id = :id');
            $pdo->bindValue(':name_mission', $name_mission);
            $pdo->bindValue(':id', $id_mission);
            $pdo->execute();
        } catch (Exception $e) {
            $response_array['status'] = 'error';
            $response_array['message'] = $e->getMessage();
            echo json_encode($response_array);
            exit();
        }
    }
}
// On retourne un code de success
$response_array['status'] = 'success';
echo json_encode($response_array);
exit();
