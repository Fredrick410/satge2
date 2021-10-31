
<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';
require_once 'verif_session_connect.php';

if (isset($_POST['id_mission'])) {
    if (!empty($_POST['id_mission'])) {
        $id_mission = htmlspecialchars($_POST['id_mission']);
    } else {
        $response_array['status'] = 'error';
        $response_array['message'] = "Identifiant de mission vide";
        echo json_encode($response_array);
        exit();
    }

    if (isset($_POST['id_task']) and !empty($_POST['id_task'])) {
        $id_task = htmlspecialchars($_POST['id_task']);
    } else {
        $response_array['status'] = 'error';
        $response_array['message'] = "Identifiant de tache vide";
        echo json_encode($response_array);
        exit();
    }

    try {
        $insert = $bdd->prepare('UPDATE task SET id_mission = :id_mission WHERE id = :id_task');
        $insert->bindValue(":id_mission", $id_mission);
        $insert->bindValue(":id_task", $id_task);
        $insert->execute();
    } catch (Exception $e) {
        $response_array['status'] = 'error';
        $response_array['message'] = $e->getMessage();
        echo json_encode($response_array);
        exit();
    }
    $response_array['status'] = 'success';
    echo json_encode($response_array);
    exit();
} else {
    if (isset($_POST['name_task']) and !empty($_POST['name_task'])) {
        $name_task = htmlspecialchars($_POST['name_task']);
    } else {
        $response_array['status'] = 'error';
        $response_array['message'] = "Nom de tâche vide";
        echo json_encode($response_array);
        exit();
    }

    if (isset($_POST['id_task']) and !empty($_POST['id_task'])) {
        $id_task = htmlspecialchars($_POST['id_task']);
    } else {
        $response_array['status'] = 'error';
        $response_array['message'] = "Identifiant de tache vide";
        echo json_encode($response_array);
        exit();
    }

    if (isset($_POST['date_task']) and !empty($_POST['date_task'])) {
        $date_task = htmlspecialchars($_POST['date_task']);
    } else {
        $response_array['status'] = 'error';
        $response_array['message'] = "Date de debut non definie";
        echo json_encode($response_array);
        exit();
    }

    if (isset($_POST['dateecheance_task']) and !empty($_POST['dateecheance_task'])) {
        $dateecheance_task = htmlspecialchars($_POST['dateecheance_task']);
    } else {
        $response_array['status'] = 'error';
        $response_array['message'] = "Date d'echeance non definie";
        echo json_encode($response_array);
        exit();
    }

    if (isset($_POST['description_task']) and !empty($_POST['description_task'])) {
        $description_task = htmlspecialchars($_POST['description_task']);
    } else {
        $response_array['status'] = 'error';
        $response_array['message'] = "Description de tache vide";
        echo json_encode($response_array);
        exit();
    }

    if (isset($_POST['new_etiq']) and !empty($_POST['new_etiq']) and isset($_POST['new_etiq_color']) and !empty($_POST['new_etiq_color'])) {
        $new_etiq = htmlspecialchars($_POST['new_etiq']);
        $new_etiq_color = htmlspecialchars($_POST['new_etiq_color']);
        $pdoSt = $bdd->prepare('SELECT * FROM etiquette WHERE color = :color and id_session = :id_session');
        $pdoSt->bindValue(':color', $new_etiq_color);
        $pdoSt->bindValue(':id_session', $_SESSION['id_session']);
        $pdoSt->execute();
        $nb_etiquette = $pdoSt->rowCount();
        if ($nb_etiquette == 0) {
            $insert = $bdd->prepare('INSERT INTO etiquette (name_etiq, color, id_session) VALUES(?,?,?)');
            $insert->execute(array(
                htmlspecialchars($new_etiq),
                htmlspecialchars($new_etiq_color),
                htmlspecialchars($_SESSION['id_session'])
            ));
            $response_array['color'] = $new_etiq_color;
        } else {
            $response_array['status'] = 'error';
            $response_array['message'] = "Etiquette de couleur existante";
            echo json_encode($response_array);
            exit();
        }
    } else if (isset($_POST['etiquette_task']) and !empty($_POST['etiquette_task'])) {
        $etiquette_task = htmlspecialchars($_POST['etiquette_task']);
        //Recuperation de l'etiquette selectionnee
        $pdoSt = $bdd->prepare('SELECT * FROM etiquette WHERE color = :color');
        $pdoSt->bindValue(':color', $etiquette_task);
        $pdoSt->execute();
        $etiquette = $pdoSt->fetch();
        $new_etiq = $etiquette['name_etiq'];
        $new_etiq_color = $etiquette['color'];
    } else {
        $response_array['status'] = 'error';
        $response_array['message'] = "Etiquette non definie";
        echo json_encode($response_array);
        exit();
    }

    if (isset($_POST['selected_membres'])) {
        $selected_membres = $_POST['selected_membres'];
    } else {
        $selected_membres = array();
    }

    if (isset($_POST['selected_teams'])) {
        $selected_teams = $_POST['selected_teams'];
    } else {
        $selected_teams = array();
    }

    if (!empty($selected_membres) or !empty($selected_teams)) {
        // Recuperation de la tache
        try {
            $insert = $bdd->prepare('SELECT * FROM task WHERE id = :id');
            $insert->bindValue(':id', $id_task);
            $insert->execute();
            $tache_debut = $insert->fetchColumn(2);
        } catch (Exception $e) {
            $response_array['status'] = 'error';
            $response_array['message'] = $e->getMessage();
            echo json_encode($response_array);
            exit();
        }
        echo $tache_debut;
        $date_task = strtotime($date_task);
        $date_task = date('Y-m-d', $date_task);
        // Si la nouvelle date est superieure a celle dans la bdd le status est en attente sinon en cours
        if ($tache_debut > $date_task) {
            $status_task = 'En cours';
        }
        else{
            $status_task = 'En attente';
        }
        // Mise a jour des infos sur la taches
        try {
            $insert = $bdd->prepare('UPDATE task SET name_task = ?, date_task = ?, dateecheance_task = ?, status_task = ?, description_task = ?, etiquette_task = ?, color_etiq = ? WHERE id = ?');
            $insert->execute(array(
                $name_task,
                $date_task,
                $dateecheance_task,
                $status_task,
                $description_task,
                $new_etiq,
                $new_etiq_color,
                $id_task
            ));
        } catch (Exception $e) {
            $response_array['status'] = 'error';
            $response_array['message'] = $e->getMessage();
            echo json_encode($response_array);
            exit();
        }

        $bdd->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);
        $bdd->beginTransaction();

        // Suppression des anciens membres puis ajout des nouveaux
        try {
            $insert = $bdd->prepare('DELETE FROM tasks_membres WHERE id_task = :id_task');
            $insert->bindValue(":id_task", $id_task);
            $insert->execute();
        } catch (Exception $e) {
            $bdd->rollBack();
            $response_array['status'] = 'error';
            $response_array['message'] = $e->getMessage();
            echo json_encode($response_array);
            exit();
        }

        if (!empty($selected_membres)) {
            foreach ($selected_membres as $membre) {
                try {
                    $insert = $bdd->prepare('INSERT INTO tasks_membres VALUES (:id_task, :id_membre)');
                    $insert->bindValue(":id_task", $id_task);
                    $insert->bindValue(":id_membre", $membre);
                    $insert->execute();
                } catch (Exception $e) {
                    $bdd->rollBack();
                    $response_array['status'] = 'error';
                    $response_array['message'] = $e->getMessage();
                    echo json_encode($response_array);
                    exit();
                }
            }
        }

        // Suppression des anciennes teams puis ajout des nouvelles
        try {
            $insert = $bdd->prepare('DELETE FROM tasks_teams WHERE id_task = :id_task');
            $insert->bindValue(":id_task", $id_task);
            $insert->execute();
        } catch (Exception $e) {
            $bdd->rollBack();
            $response_array['status'] = 'error';
            $response_array['message'] = $e->getMessage();
            echo json_encode($response_array);
            exit();
        }

        if (!empty($selected_teams)) {
            foreach ($selected_teams as $team) {
                try {
                    $insert = $bdd->prepare('INSERT INTO tasks_teams VALUES (:id_task, :id_team)');
                    $insert->bindValue(":id_task", $id_task);
                    $insert->bindValue(":id_team", $team);
                    $insert->execute();
                } catch (Exception $e) {
                    $bdd->rollBack();
                    $response_array['status'] = 'error';
                    $response_array['message'] = $e->getMessage();
                    echo json_encode($response_array);
                    exit();
                }
            }
        }

        $bdd->commit();
        $bdd->setAttribute(PDO::ATTR_AUTOCOMMIT, 1);
        $response_array['status'] = 'success';
        echo json_encode($response_array);
        exit();
    } else {
        $response_array['status'] = 'error';
        $response_array['message'] = "Tache assignee a personne";
        echo json_encode($response_array);
        exit();
    }
}
?>