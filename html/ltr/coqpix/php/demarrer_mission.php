<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';
require_once 'verif_session_connect.php';

// On demarre toutes les activites d'aujourd'hui et on notifie des activites de demain
try {
    $pdo = $bdd->prepare('UPDATE task SET status_task="En cours" WHERE date_task=:date_task');
    $pdo->bindValue(":date_task", date('Y-m-d'));
    $pdo->execute();
    if ($pdo->rowCount() > 1) {
        $type_demande = 'taches aujourd\'hui';
        $date_donner = date('Y/m/d');
    } else if ($pdo->rowCount() == 1) {
        $type_demande = 'tache aujourd\'hui';
        $date_donner = date('Y/m/d');
    }
    if (isset($type_demande)) {
        $insert_notif = $bdd->prepare('INSERT INTO notif_front (type_demande, date_donner, id_session) VALUES(?,?,?)');
        $insert_notif->execute(array(
            htmlspecialchars($type_demande),
            htmlspecialchars($date_donner),
            htmlspecialchars($_SESSION['id_session'])
        ));
    }
    unset($type_demande);
    $tomorrow = date("Y-m-d", strtotime('tomorrow'));
    $pdo = $bdd->prepare('SELECT COUNT(*) AS nb_task FROM task WHERE status_task="En attente" AND date_task=:date_task');
    $pdo->bindValue(":date_task", $tomorrow);
    $pdo->execute();
    $nb_task = $pdo->fetch();
    echo $nb_task['nb_task'];
    if ($nb_task['nb_task'] > 1) {
        $type_demande = 'taches demain';
        $date_donner = date('Y/m/d');
    } else if ($nb_task['nb_task'] == 1) {
        $type_demande = 'tache demain';
        $date_donner = date('Y/m/d');
    }
    if (isset($type_demande)) {
        $insert_notif = $bdd->prepare('SELECT COUNT(*) AS nb_notifs FROM notif_front WHERE id_session = :id_session AND date_donner = :date_donner AND type_demande = "taches demain" OR type_demande = "tache demain"');
        $insert_notif->bindValue(':id_session', $_SESSION['id_session']);
        $insert_notif->bindValue(':date_donner', $date_donner);
        $insert_notif->execute();
        $nb_notifs = $insert_notif->fetch();
        if ($nb_notifs['nb_notifs'] != 1) {
            $insert_notif = $bdd->prepare('DELETE FROM notif_front WHERE id_session = :id_session AND date_donner = :date_donner AND type_demande = "taches demain" OR type_demande = "tache demain"');
            $insert_notif->bindValue(':id_session', $_SESSION['id_session']);
            $insert_notif->bindValue(':date_donner', $date_donner);
            $insert_notif->execute();
            $insert_notif = $bdd->prepare('INSERT INTO notif_front (type_demande, date_donner, id_session) VALUES(?,?,?)');
            $insert_notif->execute(array(
                htmlspecialchars($type_demande),
                htmlspecialchars($date_donner),
                htmlspecialchars($_SESSION['id_session'])
            ));
        }
        else{
            $insert_notif = $bdd->prepare('UPDATE notif_front SET type_demande = :type_demande WHERE id_session = :id_session AND date_donner = :date_donner AND type_demande = "taches demain" OR type_demande = "tache demain"');
            $insert_notif->bindValue(':type_demande', $type_demande);
            $insert_notif->bindValue(':id_session', $_SESSION['id_session']);
            $insert_notif->bindValue(':date_donner', $date_donner);
            $insert_notif->execute();
        }
    }
} catch (Exception $e) {
    $response_array['status'] = 'error';
    $response_array['message'] = $e->getMessage();
    echo json_encode($response_array);
    exit();
}
$response_array['status'] = 'success';
echo json_encode($response_array);
exit();
