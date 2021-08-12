<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';
require_once 'verif_session_connect.php';

try {
    $par = $_SESSION['id_membre'];
    $date_jm = date("d/m");
    $date_j = date("d");
    $date_m = date("m");
    $date_a = date("Y");
    $date_h = date("H");
    $date_min = date("i");
    $date_hmin = '' . $date_h . ':' . $date_min . '';
    $content = $_POST['content'];
    $task_num = $_POST['num'];
    $date_com = date(DATE_RFC2822);
    $img_profile = "";
    $type_task = "commentaire";

    $bdd->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);
    $bdd->beginTransaction();

    $insert = $bdd->prepare('INSERT INTO task_commentaire (par, date_jm, date_hmin, content, task_num, id_session) VALUES((SELECT CONCAT(nom, " ", prenom) AS name_membre FROM membres WHERE id = ?),?,?,?,?,?)');
    $insert->execute(array(
        htmlspecialchars($par),
        htmlspecialchars($date_jm),
        htmlspecialchars($date_hmin),
        htmlspecialchars($content),
        htmlspecialchars($task_num),
        htmlspecialchars($_SESSION['id_session'])
    ));

    $pdo = $bdd->prepare('UPDATE task SET lastcommentaire_task=:lastcommentaire_task WHERE id=:num LIMIT 1');
    $pdo->bindValue(':num', $task_num);
    $pdo->bindValue(':lastcommentaire_task', $date_com);
    $pdo->execute();

    $insert = $bdd->prepare('INSERT INTO task_recent (par, type_task, date_j, date_m, date_a, date_h, date_min, img_profile, task_num, id_session) VALUES(?,?,?,?,?,?,?,?,?,?)');
    $insert->execute(array(
        htmlspecialchars($par),
        htmlspecialchars($type_task),
        htmlspecialchars($date_j),
        htmlspecialchars($date_m),
        htmlspecialchars($date_a),
        htmlspecialchars($date_h),
        htmlspecialchars($date_min),
        htmlspecialchars($img_profile),
        htmlspecialchars($task_num),
        htmlspecialchars($_SESSION['id_session'])
    ));
} catch (Exception $e) {
    $bdd->rollBack();
    $response_array['status'] = 'error';
    $response_array['message'] = $e->getMessage();
    echo json_encode($response_array);
    exit();
}
$bdd->commit();
$bdd->setAttribute(PDO::ATTR_AUTOCOMMIT, 1);
$response_array['status'] = 'success';
echo json_encode($response_array);
exit();
