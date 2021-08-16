<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';
require_once 'verif_session_connect.php';

$storeFolder = "../../../../src/task/document/";

// On verifie l'existance des parametres
if (isset($_POST['id_task']) and isset($_POST['namedoc_task'])) {
    // On verifie si les parametres sont non vides
    // Si oui, on retourne un message d'erreur
    try {
        if (!empty($_POST['id_task'])) {
            $id_task = htmlspecialchars($_POST['id_task']);
        } else {
            $response_array['status'] = 'success';
            $response_array['message'] = "Identifiant de tache vide";
            echo json_encode($response_array);
            exit();
        }
        if (!empty($_POST['namedoc_task'])) {
            $namedoc_task = htmlspecialchars($_POST['namedoc_task']);
        } else {
            $response_array['status'] = 'error';
            $response_array['message'] = "Fichier non selectionne";
            echo json_encode($response_array);
            exit();
        }
    } catch (Exception $e) {
        $response_array['status'] = 'error';
        $response_array['message'] = $e->getMessage();
        echo json_encode($response_array);
        exit();
    }

    try {
        $deleted = unlink($storeFolder . $namedoc_task);
    } catch (Exception $e) {
        $response_array['status'] = 'error';
        $response_array['message'] = $e->getMessage();
        echo json_encode($response_array);
        exit();
    }

    // On supprime le fichier de la bdd
    if ($deleted === true) {
        try {
            $pdo = $bdd->prepare('DELETE FROM task_doc WHERE task_num = :id AND namedoc_task = :namedoc_task');
            $pdo->bindValue(':id', $id_task);
            $pdo->bindValue(':namedoc_task', $namedoc_task);
            $pdo->execute();
        } catch (Exception $e) {
            $response_array['status'] = 'error';
            $response_array['message'] = $e->getMessage();
            echo json_encode($response_array);
            exit();
        }
        $response_array['status'] = 'success';
        echo json_encode($response_array);
        exit();
    }
}
// On retourne un code de success
$response_array['status'] = 'error';
$response_array['message'] = 'Champ manquant';
echo json_encode($response_array);
exit();
