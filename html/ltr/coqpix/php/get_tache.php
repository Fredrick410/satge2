<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';
require_once 'verif_session_connect.php';

$storeFolder = "../../../../src/task/document/";

if (isset($_POST['id_task']) and !empty($_POST['id_task'])) {
    $id_task = htmlspecialchars($_POST['id_task']);
} else {
    $response_array['status'] = 'error';
    $response_array['message'] = "Identifiant de tâche vide";
    echo json_encode($response_array);
    exit();
}

try {
    $pdo = $bdd->prepare('SELECT * FROM task WHERE id=:id');
    $pdo->bindValue(":id", $id_task, PDO::PARAM_INT);
    $pdo->execute();
    $task = $pdo->fetch(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $response_array['status'] = 'error';
    $response_array['message'] = $e->getMessage();
    echo json_encode($response_array);
    exit();
}

try {
    //On recupere la liste des equipes associees a la tache
    $pdoS = $bdd->prepare('SELECT * FROM tasks_teams WHERE id_task = :num');
    $pdoS->bindValue(':num', $id_task);
    $pdoS->execute();
    $teams = $pdoS->fetchAll();
} catch (Exception $e) {
    $response_array['status'] = 'error';
    $response_array['message'] = $e->getMessage();
    echo json_encode($response_array);
    exit();
}

try {
    //On recupere la liste des membres associes a la tache
    $pdoS = $bdd->prepare('SELECT * FROM tasks_membres WHERE id_task = :num');
    $pdoS->bindValue(':num', $id_task);
    $pdoS->execute();
    $membres = $pdoS->fetchAll();
} catch (Exception $e) {
    $response_array['status'] = 'error';
    $response_array['message'] = $e->getMessage();
    echo json_encode($response_array);
    exit();
}

try {
    //On recupere la liste des fichiers associes a la tache
    $pdoS = $bdd->prepare('SELECT namedoc_task AS name FROM task_doc WHERE task_num = :num');
    $pdoS->bindValue(':num', $id_task);
    $pdoS->execute();
    $adocs = $pdoS->fetchAll();
} catch (Exception $e) {
    $response_array['status'] = 'error';
    $response_array['message'] = $e->getMessage();
    echo json_encode($response_array);
    exit();
}
foreach ($adocs as $doc) {
    $obj['name'] = $doc['name'];
    $obj['size'] = filesize($storeFolder.$doc['name']);
    $docs[] = $obj;
}
if(!isset($docs)){
    $docs = array();
}
$response_array['task'] = $task;
$response_array['membres'] = $membres;
$response_array['teams'] = $teams;
$response_array['docs'] = $docs;
$response_array['status'] = 'success';
echo json_encode($response_array);
exit();
