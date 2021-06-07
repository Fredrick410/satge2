
<?php
    
session_start();
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    if($_GET['page'] == "task"){
        $pdoSta = $bdd->prepare('SELECT * FROM task WHERE id = :num');
        $pdoSta->bindValue(':num',$_GET['num'], PDO::PARAM_INT);
        $pdoSta->execute();   
        $task = $pdoSta->fetch();
    }
    if($_GET['page'] == "del"){
        $pdoSta = $bdd->prepare('SELECT * FROM task_delete WHERE id = :num');
        $pdoSta->bindValue(':num',$_GET['num'], PDO::PARAM_INT);
        $pdoSta->execute();   
        $task = $pdoSta->fetch();
    }

    $id = $_GET['num'];
    $name_task = $task['name_task'];
    $date_task = $task['date_task'];
    $dateecheance_task = $task['dateecheance_task'];
    $status_task = $task['status_task'];
    $favorite = $task['favorite'];
    $assignation_task = $task['assignation_task'];
    $description_task = $task['description_task'];
    $etiquette_task = $task['etiquette_task'];
    $color_etiq = $task['color_etiq'];
    $date_crea = $task['date_crea'];
    $commentaire_task = $task['commentaire_task'];
    $lastcommentaire_task = $task['lastcommentaire_task'];
    $projet_task = $task['projet_task'];
    $id_session = $_SESSION['id_session'];

    if($status_task == "encour" || $status_task == "terminée"){

        $insert = $bdd->prepare('INSERT INTO task_delete (id, name_task, date_task, dateecheance_task, status_task, favorite, assignation_task, description_task, etiquette_task, color_etiq, date_crea, commentaire_task, lastcommentaire_task, projet_task, id_session) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
        $insert->execute(array(
        ($id),
        ($name_task),
        ($date_task),
        ($dateecheance_task),
        ("delete"),
        ($favorite),
        ($assignation_task),
        ($description_task),
        ($etiquette_task),
        ($color_etiq),
        ($date_crea),
        ($commentaire_task),
        ($lastcommentaire_task),
        ($projet_task),
        ($id_session)
    ));

    $pdoDel = $bdd->prepare('DELETE FROM task WHERE id=:num LIMIT 1');
    $pdoDel->bindValue(':num', $_GET['num']);
    $pdoDel->execute();

    header('Location: ../task.php');
    exit();

    }else{

        if($status_task == "delete"){
        
        $insert = $bdd->prepare('INSERT INTO task (id, name_task, date_task, dateecheance_task, status_task, favorite, assignation_task, description_task, etiquette_task, color_etiq, date_crea, commentaire_task, lastcommentaire_task, projet_task, id_session) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
        $insert->execute(array(
        ($id),
        ($name_task),
        ($date_task),
        ($dateecheance_task),
        ("encour"),
        ($favorite),
        ($assignation_task),
        ($description_task),
        ($etiquette_task),
        ($color_etiq),
        ($date_crea),
        ($commentaire_task),
        ($lastcommentaire_task),
        ($projet_task),
        ($id_session)
    ));

    $pdoDel = $bdd->prepare('DELETE FROM task_delete WHERE id=:num LIMIT 1');
    $pdoDel->bindValue(':num', $_GET['num']);
    $pdoDel->execute();

    header('Location: ../task.php');
    exit();

    }   
}

?>