<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';
require_once 'verif_session_connect.php';

if (isset($_POST['id_task']) and !empty($_POST['id_task'])) {
    $id_task = htmlspecialchars($_POST['id_task']);
} else {
    $response_array['status'] = 'error';
    $response_array['message'] = "Identifiant de tâche vide";
    echo json_encode($response_array);
    exit();
}

try {
    //On recupere la liste des commentaires associes a la tache
    $pdoS = $bdd->prepare('SELECT * FROM task_commentaire WHERE task_num = :num');
    $pdoS->bindValue(':num', $id_task);
    $pdoS->execute();
    $comments = $pdoS->fetchAll();
} catch (Exception $e) {
    $response_array['status'] = 'error';
    $response_array['message'] = $e->getMessage();
    echo json_encode($response_array);
    exit();
}

$has_comments = (count($comments) > 0);
$response_array['comments'] = $comments;
$response_array['has_comments'] = $has_comments;
$response_array['status'] = 'success';
echo json_encode($response_array);
exit();
