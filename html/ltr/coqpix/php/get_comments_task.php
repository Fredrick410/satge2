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
    $response_array['message'] = "Identifiant de tache vide";
    echo json_encode($response_array);
    exit();
}

if (isset($_POST['current_page']) and !empty($_POST['current_page']) and is_numeric($_POST['current_page'])) {
    $current_page = htmlspecialchars($_POST['current_page']);
} else {
    $current_page = 1;
}

try {
    //On recupere le nombre de commentaires associes a la tache
    $pdoS = $bdd->prepare('SELECT COUNT(*) AS nb_comments FROM task_commentaire WHERE task_num = :num');
    $pdoS->bindValue(':num', $id_task);
    $pdoS->execute();
    $nb_comments = $pdoS->fetch();
} catch (Exception $e) {
    $response_array['status'] = 'error';
    $response_array['message'] = $e->getMessage();
    echo json_encode($response_array);
    exit();
}

// On determine le nombre de page en prenant 5 commentaires par page
$nbPages = (int)ceil($nb_comments['nb_comments']/5);

// On determine la position du premier element de la page
$premier = 5*($current_page-1);

try {
    //On recupere les 5 commentaires associes a la tache de la page demandees
    $pdoS = $bdd->prepare('SELECT * FROM task_commentaire WHERE task_num = :num LIMIT :premier, :nb_pages');
    $pdoS->bindValue(':num', $id_task);
    $pdoS->bindValue(':premier', $premier, PDO::PARAM_INT);
    $pdoS->bindValue(':nb_pages', 5, PDO::PARAM_INT);
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
$response_array['status'] = 'success';
echo json_encode($response_array);
exit();
